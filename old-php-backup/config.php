<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'u925970186_sbi');
define('DB_USER', 'u925970186_sbi'); // Change to your Hostinger DB user
define('DB_PASS', '!Exacc2025');            // NOTE: Add your Hostinger DB password here
define('DB_CHARSET', 'utf8mb4');

define('SITE_URL', 'https://snow-wren-797125.hostingersite.com'); // Change to your domain
define('SITE_NAME', 'Small Business Institute');
define('ADMIN_PATH', '/admin');

// Mailchimp
define('MAILCHIMP_FORM_ACTION', ''); // Paste your Mailchimp form action URL here

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed. Please check your config.php settings.');
}

session_start();
