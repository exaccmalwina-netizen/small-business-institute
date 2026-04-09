<?php
require_once 'config.php';
require_once 'includes/helpers.php';

$perPage    = 9;
$page       = max(1, (int)($_GET['p'] ?? 1));
$activeCat  = $_GET['cat'] ?? '';
$offset     = ($page - 1) * $perPage;

$categories = getCategories($pdo);

// Build query
$where  = "p.status = 'published'";
$params = [];

if ($activeCat) {
    $where  .= " AND c.slug = ?";
    $params[] = $activeCat;
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE $where");
$countStmt->execute($params);
$total = (int)$countStmt->fetchColumn();
$pages = (int)ceil($total / $perPage);

$params[] = $perPage;
$params[] = $offset;

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, c.slug AS category_slug
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE $where
    ORDER BY p.created_at DESC
    LIMIT ? OFFSET ?
");
$stmt->execute($params);
$posts = $stmt->fetchAll();

$catName = '';
if ($activeCat) {
    foreach ($categories as $c) {
        if ($c['slug'] === $activeCat) { $catName = $c['name']; break; }
    }
}

$pageTitle = $catName ? $catName . ' Articles' : 'Resources & Articles';
$metaDesc  = 'Practical guides and articles for Australian small business owners and independent contractors.';
?>
<?php include 'includes/header.php'; ?>

<div class="blog-header">
    <div class="container">
        <h1><?= $catName ? e($catName) : 'Resources & Articles' ?></h1>
        <p>Plain-English guides for Australian small business owners.</p>
    </div>
</div>

<div class="section">
    <div class="container">

        <!-- Category filter -->
        <div class="category-pills">
            <a href="/blog.php" class="pill <?= !$activeCat ? 'active' : '' ?>">All</a>
            <?php foreach ($categories as $cat): ?>
            <a href="/blog.php?cat=<?= e($cat['slug']) ?>" class="pill <?= $activeCat === $cat['slug'] ? 'active' : '' ?>">
                <?= e($cat['name']) ?>
            </a>
            <?php endforeach; ?>
        </div>

        <?php if (empty($posts)): ?>
        <div style="text-align:center;padding:5rem 0;color:var(--muted)">
            <p style="font-size:1.15rem;margin-bottom:.5rem">No articles yet<?= $catName ? ' in ' . e($catName) : '' ?>.</p>
            <p>Check back soon.</p>
        </div>
        <?php else: ?>

        <div class="posts-grid">
            <?php foreach ($posts as $post): ?>
            <article class="post-card">
                <div class="post-card-image">
                    <?php if ($post['featured_image']): ?>
                        <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title']) ?>">
                    <?php else: ?>
                        <div class="post-card-image-placeholder"><span>📄</span></div>
                    <?php endif; ?>
                </div>
                <div class="post-card-body">
                    <div class="post-card-meta">
                        <?php if ($post['category_name']): ?>
                        <span class="post-cat-badge"><?= e($post['category_name']) ?></span>
                        <?php endif; ?>
                        <span class="post-date"><?= formatDate($post['created_at']) ?></span>
                    </div>
                    <h3><a href="/post.php?slug=<?= e($post['slug']) ?>"><?= e($post['title']) ?></a></h3>
                    <p><?= e(truncate($post['excerpt'] ?: $post['content'], 150)) ?></p>
                    <div class="post-card-footer">
                        <a href="/post.php?slug=<?= e($post['slug']) ?>" class="read-more">Read article →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pages > 1): ?>
        <nav class="pagination" aria-label="Pagination">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="/blog.php?<?= $activeCat ? 'cat=' . e($activeCat) . '&' : '' ?>p=<?= $i ?>"
               class="page-link <?= $i === $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
            <?php endfor; ?>
        </nav>
        <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
