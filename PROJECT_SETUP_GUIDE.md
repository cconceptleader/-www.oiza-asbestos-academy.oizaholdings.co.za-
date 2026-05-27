# OIZA-ASBESTOS Academy - Complete Project Setup Guide

## What You Need to Push to GitHub

Below is the complete file structure and contents for your GitHub repository. Create these files and folders locally, then push to GitHub.

---

## PROJECT STRUCTURE

```
root/
├── index.html
├── modules.html
├── pricing.html
├── enrol.html
├── verify.html
├── facilitator.html
├── login.html
├── README.md
├── CNAME
├── .gitignore
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── main.js
├── backend/
│   ├── includes/
│   │   └── config.php
│   ├── api/
│   │   ├── enrol.php
│   │   ├── login.php
│   │   └── verify.php
│   └── db/
│       └── schema.sql
└── .github/
    └── workflows/
        └── deploy.yml (optional)
```

---

## STEP-BY-STEP SETUP

### 1. Create Assets Folder
- Create folder: `assets/css/`
- Create folder: `assets/js/`

### 2. Create Backend Folder
- Create folder: `backend/includes/`
- Create folder: `backend/api/`
- Create folder: `backend/db/`

### 3. Create Configuration File
Create: `backend/includes/config.php`

```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'oiza_academy');
define('DB_PORT', 3306);

// API Configuration
define('API_URL', 'http://localhost/backend/api');
define('FRONTEND_URL', 'http://localhost');

// Site Configuration
define('SITE_NAME', 'OIZA-ASBESTOS Abatement Academy');
define('SITE_EMAIL', 'info@oiza-asbestos.oizaholdings.co.za');

// JWT Configuration
define('JWT_SECRET', 'your-secret-key-change-this');
define('JWT_EXPIRY', 86400);

// File Upload Configuration
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024);
define('UPLOAD_DIR', __DIR__ . '/../uploads/');

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
?>
```

### 4. Create Database Schema
Create: `backend/db/schema.sql`

(Use the schema provided in PROJECT_SETUP_GUIDE.md database section)

### 5. Create CSS File
Create: `assets/css/style.css`

(Use the complete CSS from PROJECT_SETUP_GUIDE.md assets section)

### 6. Create Basic PHP API
Create: `backend/api/enrol.php`

```php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['email']) || !isset($data['first_name'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }
    
    // TODO: Connect to database and create enrolment
    echo json_encode(['success' => true, 'message' => 'Enrolment created']);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>
```

### 7. Update Root Files

Create: `.gitignore`
```
.DS_Store
backend/includes/config.php
uploads/
*.log
node_modules/
```

Create: `CNAME`
```
www.oiza-asbestos-academy.oizaholdings.co.za
```

---

## NEXT STEPS

1. **Locally on your computer:**
   - Create the folder structure above
   - Copy all HTML files (index.html already exists)
   - Copy CSS and JS files
   - Copy PHP backend files
   - Copy database schema

2. **Push to GitHub:**
   ```bash
   git add .
   git commit -m "Initial project setup with HTML, CSS, and PHP backend"
   git push origin main
   ```

3. **Deploy Frontend:**
   - Go to GitHub repository → Settings → Pages
   - Enable GitHub Pages
   - Select main branch as source
   - Add custom domain: www.oiza-asbestos-academy.oizaholdings.co.za

4. **Deploy Backend:**
   - Host PHP files on a separate server
   - Create MySQL database with schema.sql
   - Update config.php with credentials

---

## FILES READY TO USE

The following files are already created and ready:
- ✅ index.html (in your academy folder)

The following files need to be created:
- modules.html
- pricing.html
- enrol.html
- verify.html
- facilitator.html
- login.html
- assets/css/style.css
- assets/js/main.js
- backend/* files

---

Would you like me to provide the complete content for any specific file?
