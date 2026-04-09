<?php
require_once '../config.php';
require_once '../includes/helpers.php';
require_once 'auth.php';
requireLogin();

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
}
redirect('/admin/');
