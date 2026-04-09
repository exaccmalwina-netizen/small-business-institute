<?php
/**
 * TinyMCE image upload endpoint.
 * Only accessible to logged-in admins.
 */
require_once '../config.php';
require_once 'auth.php';
requireLogin();

header('Content-Type: application/json');

if (empty($_FILES['file']['name'])) {
    echo json_encode(['error' => ['message' => 'No file uploaded.', 'code' => 400]]);
    exit;
}

$ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
if (!in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
    echo json_encode(['error' => ['message' => 'Invalid file type.', 'code' => 400]]);
    exit;
}

$uploadDir = dirname(__DIR__) . '/uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$filename = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
$dest     = $uploadDir . $filename;

if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
    echo json_encode(['location' => '/uploads/' . $filename]);
} else {
    echo json_encode(['error' => ['message' => 'Upload failed.', 'code' => 500]]);
}
