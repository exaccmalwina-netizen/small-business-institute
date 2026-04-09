<?php
require_once '../config.php';
require_once '../includes/helpers.php';
require_once 'auth.php';
requireLogin();

// Stats
$totalPosts     = $pdo->query("SELECT COUNT(*) FROM posts WHERE status='published'")->fetchColumn();
$totalDrafts    = $pdo->query("SELECT COUNT(*) FROM posts WHERE status='draft'")->fetchColumn();
$totalCats      = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();

// Recent posts
$recentPosts = $pdo->query("
    SELECT p.*, c.name AS category_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.updated_at DESC
    LIMIT 8
")->fetchAll();
?>
<?php include 'admin-header.php'; ?>

<div class="admin-page-header">
    <div>
        <h1>Dashboard</h1>
        <p>Welcome back. Manage your articles and content below.</p>
    </div>
    <a href="/admin/post-edit.php" class="btn-admin btn-admin-primary">+ New Article</a>
</div>

<!-- Stats -->
<div class="stat-cards">
    <div class="stat-card">
        <span class="stat-card-num"><?= $totalPosts ?></span>
        <span class="stat-card-label">Published</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-num"><?= $totalDrafts ?></span>
        <span class="stat-card-label">Drafts</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-num"><?= $totalCats ?></span>
        <span class="stat-card-label">Categories</span>
    </div>
    <div class="stat-card">
        <a href="/" target="_blank" style="text-decoration:none;color:inherit">
            <span class="stat-card-num" style="font-size:1.4rem">↗</span>
            <span class="stat-card-label">View site</span>
        </a>
    </div>
</div>

<!-- Posts table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2>All articles</h2>
        <a href="/admin/post-edit.php" class="btn-admin btn-admin-sm">+ New</a>
    </div>
    <?php if (empty($recentPosts)): ?>
    <div class="empty-state">
        <p>No articles yet. <a href="/admin/post-edit.php">Create your first one</a>.</p>
    </div>
    <?php else: ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($recentPosts as $post): ?>
        <tr>
            <td><strong><?= e($post['title']) ?></strong></td>
            <td><?= e($post['category_name'] ?? '—') ?></td>
            <td>
                <span class="status-badge status-<?= $post['status'] ?>">
                    <?= ucfirst($post['status']) ?>
                </span>
            </td>
            <td><?= formatDate($post['updated_at']) ?></td>
            <td class="actions-cell">
                <a href="/admin/post-edit.php?id=<?= $post['id'] ?>" class="btn-admin btn-admin-sm">Edit</a>
                <?php if ($post['status'] === 'published'): ?>
                <a href="/post.php?slug=<?= e($post['slug']) ?>" target="_blank" class="btn-admin btn-admin-sm btn-admin-ghost">View</a>
                <?php endif; ?>
                <a href="/admin/post-delete.php?id=<?= $post['id'] ?>"
                   class="btn-admin btn-admin-sm btn-admin-danger"
                   onclick="return confirm('Delete this article? This cannot be undone.')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php include 'admin-footer.php'; ?>
