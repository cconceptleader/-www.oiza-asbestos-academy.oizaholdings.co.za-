<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/app/config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$orderId = (int)($_GET['order'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT
        o.id,
        o.payment_status,
        p.title AS programme_title
     FROM orders o
     INNER JOIN programmes p
        ON p.id = o.programme_id
     WHERE o.id = :order_id
       AND o.user_id = :user_id
     LIMIT 1"
);

$stmt->execute([
    ':order_id' => $orderId,
    ':user_id' => (int)$_SESSION['user_id']
]);

$order = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment received</title>
</head>
<body>
    <h1>Thank you</h1>

    <?php if ($order && $order['payment_status'] === 'paid'): ?>
        <p>
            Your payment for
            <strong><?= htmlspecialchars($order['programme_title']) ?></strong>
            has been received.
        </p>

        <p>
            <a href="learner_dashboard.php">Go to my dashboard</a>
        </p>
    <?php else: ?>
        <p>
            Your payment is being processed. You will receive access once it is confirmed.
        </p>

        <p>
            <a href="learner_dashboard.php">Go to my dashboard</a>
        </p>
    <?php endif; ?>
</body>
</html>