<?php
// Called after config.php (which starts session)
function requireLogin(): void {
    if (empty($_SESSION['admin_id'])) {
        header('Location: /admin/login.php');
        exit;
    }
}

function adminLogin(PDO $pdo, string $username, string $password): bool {
    $stmt = $pdo->prepare("SELECT id, password_hash FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    if ($row && password_verify($password, $row['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $row['id'];
        return true;
    }
    return false;
}
