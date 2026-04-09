<?php
/**
 * SBI Install Script
 * Run once at: yourdomain.com/install.php
 * DELETE this file after running.
 */
require_once 'config.php';

$sql = "
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    category_id INT,
    featured_image VARCHAR(255),
    status ENUM('draft','published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO categories (name, slug) VALUES
    ('Employment', 'employment'),
    ('Business Management', 'business-management'),
    ('Compliance', 'compliance'),
    ('Insurance', 'insurance'),
    ('New Technologies', 'new-technologies'),
    ('Success Stories', 'success-stories'),
    ('Failure Stories', 'failure-stories');

INSERT IGNORE INTO admins (username, password_hash) VALUES
    ('admin', '" . password_hash('changeme123', PASSWORD_DEFAULT) . "');
";

try {
    $pdo->exec($sql);
    echo '<h2 style=\"font-family:sans-serif\">Install complete.</h2>
          <p style=\"font-family:sans-serif\">Default admin login:<br>
          <strong>Username:</strong> admin<br>
          <strong>Password:</strong> changeme123</p>
          <p style=\"color:red;font-family:sans-serif\"><strong>Change your password immediately, then delete this file.</strong></p>
          <p><a href=\"/admin/\">Go to Admin Panel</a></p>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
