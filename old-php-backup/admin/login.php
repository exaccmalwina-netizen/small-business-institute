<?php
require_once '../config.php';
require_once '../includes/helpers.php';
require_once 'auth.php';

if (!empty($_SESSION['admin_id'])) {
    redirect('/admin/');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (adminLogin($pdo, $username, $password)) {
        redirect('/admin/');
    }
    $error = 'Incorrect username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — SBI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <span class="logo-mark">SBI</span>
        <span>Admin</span>
    </div>
    <h1>Sign in</h1>
    <?php if ($error): ?>
    <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus
                   value="<?= e($_POST['username'] ?? '') ?>">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary" style="width:100%">Sign in</button>
    </form>
    <p style="margin-top:1.5rem;text-align:center"><a href="/" style="color:var(--a-muted);font-size:.85rem">← Back to site</a></p>
</div>
</body>
</html>
