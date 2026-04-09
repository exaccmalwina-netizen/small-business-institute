<?php
require_once 'config.php';
require_once 'includes/helpers.php';

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header('Location: /blog.php');
    exit;
}

$post = getPostBySlug($pdo, $slug);
if (!$post) {
    http_response_code(404);
    $pageTitle = 'Article Not Found';
    include 'includes/header.php';
    echo '<div class="container" style="padding:6rem 0;text-align:center"><h1>Article not found</h1><p><a href="/blog.php">Browse all articles</a></p></div>';
    include 'includes/footer.php';
    exit;
}

$recentPosts = getRecentPosts($pdo, 4, $post['id']);

$pageTitle = $post['title'];
$metaDesc  = truncate($post['excerpt'] ?: $post['content'], 160);
?>
<?php include 'includes/header.php'; ?>

<div class="post-header">
    <div class="container">
        <?php if ($post['category_name']): ?>
        <a href="/blog.php?cat=<?= e($post['category_slug']) ?>" class="post-cat-badge"><?= e($post['category_name']) ?></a>
        <?php endif; ?>
        <h1><?= e($post['title']) ?></h1>
        <div class="post-header-meta">
            <span><?= formatDate($post['created_at']) ?></span>
            <?php if ($post['updated_at'] !== $post['created_at']): ?>
            <span>Updated <?= formatDate($post['updated_at']) ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="post-layout">

        <!-- Main content -->
        <main>
            <?php if ($post['featured_image']): ?>
            <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title']) ?>"
                 style="width:100%;border-radius:var(--radius-lg);margin-bottom:2rem;max-height:420px;object-fit:cover">
            <?php endif; ?>

            <article class="post-body">
                <?= $post['content'] /* Content is from trusted admin only */ ?>
            </article>

            <!-- Back link -->
            <div style="margin-top:2rem">
                <?php if ($post['category_name']): ?>
                <a href="/blog.php?cat=<?= e($post['category_slug']) ?>" class="btn btn-outline">
                    ← More <?= e($post['category_name']) ?> articles
                </a>
                <?php else: ?>
                <a href="/blog.php" class="btn btn-outline">← All articles</a>
                <?php endif; ?>
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="post-sidebar">

            <!-- Newsletter -->
            <div class="sidebar-card sidebar-newsletter">
                <h4>Newsletter</h4>
                <p>Practical insights for Australian small business owners. No spam.</p>
                <button class="btn btn-primary" onclick="openNewsletter()">Subscribe free</button>
            </div>

            <!-- Recent posts -->
            <?php if ($recentPosts): ?>
            <div class="sidebar-card">
                <h4>More articles</h4>
                <?php foreach ($recentPosts as $rp): ?>
                <a href="/post.php?slug=<?= e($rp['slug']) ?>" class="sidebar-post">
                    <?php if ($rp['featured_image']): ?>
                        <img src="<?= e($rp['featured_image']) ?>" alt="" class="sidebar-post-img">
                    <?php else: ?>
                        <div class="sidebar-post-img" style="display:flex;align-items:center;justify-content:center;font-size:1.4rem">📄</div>
                    <?php endif; ?>
                    <div class="sidebar-post-info">
                        <h5><?= e($rp['title']) ?></h5>
                        <span><?= formatDate($rp['created_at']) ?></span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Browse topics -->
            <div class="sidebar-card">
                <h4>Browse topics</h4>
                <div style="display:flex;flex-wrap:wrap;gap:.4rem">
                    <?php foreach (getCategories($pdo) as $cat): ?>
                    <a href="/blog.php?cat=<?= e($cat['slug']) ?>" class="pill"><?= e($cat['name']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        </aside>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
