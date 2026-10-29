<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../config/payfast.php';

function generatePayfastSignature(array $data, ?string $passphrase = null): string
{
    ksort($data);

    $output = '';

    foreach ($data as $key => $value) {
        if ($value !== '' && $value !== null) {
            $output .= $key . '=' . urlencode(trim((string)$value)) . '&';
        }
    }

    $output = substr($output, 0, -1);

    if ($passphrase !== null && $passphrase !== '') {
        $output .= '&passphrase=' . urlencode(trim($passphrase));
    }

    return md5($output);
}

$payfastData = $_POST;

if (empty($payfastData)) {
    http_response_code(400);
    exit('Invalid request');
}

$receivedSignature = $payfastData['signature'] ?? '';

unset($payfastData['signature']);

$expectedSignature = generatePayfastSignature(
    $payfastData,
    $payfastConfig['passphrase']
);

if (!hash_equals($expectedSignature, $receivedSignature)) {
    http_response_code(403);
    exit('Invalid signature');
}

$orderId = (int)($payfastData['m_payment_id'] ?? 0);
$paymentStatus = strtolower((string)($payfastData['payment_status'] ?? ''));
$payfastAmount = (float)($payfastData['amount_gross'] ?? 0);
$payfastPaymentId = (string)($payfastData['pf_payment_id'] ?? '');

if ($orderId <= 0 || $payfastPaymentId === '') {
    http_response_code(400);
    exit('Invalid payment data');
}

$stmt = $pdo->prepare(
    "SELECT
        o.id,
        o.amount,
        o.payment_status,
        o.payment_reference
     FROM orders o
     WHERE o.id = :order_id
     LIMIT 1"
);

$stmt->execute([':order_id' => $orderId]);
$order = $stmt->fetch();

if (!$order) {
    http_response_code(404);
    exit('Order not found');
}

/* Prevent duplicate ITN processing */
if (
    $order['payment_status'] === 'paid'
    && $order['payment_reference'] === $payfastPaymentId
) {
    http_response_code(200);
    exit('OK');
}

/* Confirm the amount matches */
if (abs($payfastAmount - (float)$order['amount']) > 0.01) {
    http_response_code(400);
    exit('Amount mismatch');
}

if ($paymentStatus !== 'complete') {
    http_response_code(200);
    exit('Payment not complete');
}

try {
    $pdo->beginTransaction();

    $orderStmt = $pdo->prepare(
        "UPDATE orders
         SET
            payment_status = 'paid',
            payment_method = 'payfast',
            payment_reference = :payment_reference
         WHERE id = :order_id
           AND payment_status != 'paid'"
    );

    $orderStmt->execute([
        ':payment_reference' => $payfastPaymentId,
        ':order_id' => $orderId
    ]);

    $enrolmentStmt = $pdo->prepare(
        "UPDATE enrolments
         SET
            access_status = 'active',
            status = 'active',
            enrolment_date = CURDATE()
         WHERE order_id = :order_id"
    );

    $enrolmentStmt->execute([
        ':order_id' => $orderId
    ]);

    $pdo->commit();

    http_response_code(200);
    echo 'OK';
} catch (PDOException $e) {
    $pdo->rollBack();

    error_log('PayFast ITN error: ' . $e->getMessage());

    http_response_code(500);
    echo 'Database error';
}