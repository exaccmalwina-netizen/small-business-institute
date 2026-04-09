<?php
function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

function truncate(string $text, int $length = 160): string {
    $text = strip_tags($text);
    if (strlen($text) <= $length) return $text;
    return rtrim(substr($text, 0, $length)) . '…';
}

function timeAgo(string $datetime): string {
    $now  = new DateTime();
    $then = new DateTime($datetime);
    $diff = $now->diff($then);

    if ($diff->y > 0) return $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
    if ($diff->m > 0) return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
    if ($diff->d > 0) return $diff->d . ' day'   . ($diff->d > 1 ? 's' : '') . ' ago';
    return 'Today';
}

function formatDate(string $datetime): string {
    return (new DateTime($datetime))->format('j F Y');
}

function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function getCategories(PDO $pdo): array {
    return $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();
}

function getPostBySlug(PDO $pdo, string $slug): ?array {
    $stmt = $pdo->prepare("
        SELECT p.*, c.name AS category_name, c.slug AS category_slug
        FROM posts p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.slug = ? AND p.status = 'published'
    ");
    $stmt->execute([$slug]);
    return $stmt->fetch() ?: null;
}

function getRecentPosts(PDO $pdo, int $limit = 4, ?int $excludeId = null): array {
    $sql = "SELECT p.*, c.name AS category_name, c.slug AS category_slug
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'published'";
    $params = [];
    if ($excludeId) {
        $sql .= " AND p.id != ?";
        $params[] = $excludeId;
    }
    $sql .= " ORDER BY p.created_at DESC LIMIT ?";
    $params[] = $limit;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}
