<?php
require_once '../config.php';
require_once '../includes/helpers.php';
require_once 'auth.php';
requireLogin();

$id         = (int)($_GET['id'] ?? 0);
$post       = [];
$errors     = [];
$success    = false;
$categories = getCategories($pdo);

// Load existing post
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    if (!$post) {
        redirect('/admin/');
    }
}

// Handle save
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title     = trim($_POST['title'] ?? '');
    $slug      = trim($_POST['slug'] ?? '') ?: slugify($title);
    $excerpt   = trim($_POST['excerpt'] ?? '');
    $content   = $_POST['content'] ?? '';
    $cat_id    = (int)($_POST['category_id'] ?? 0) ?: null;
    $status    = $_POST['status'] === 'published' ? 'published' : 'draft';
    $img       = $post['featured_image'] ?? '';

    if (!$title)   $errors[] = 'Title is required.';
    if (!$content) $errors[] = 'Content is required.';

    // Handle image upload
    if (!empty($_FILES['featured_image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
            $errors[] = 'Image must be jpg, png, webp, or gif.';
        } else {
            $uploadDir = dirname(__DIR__) . '/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $filename = time() . '_' . preg_replace('/[^a-z0-9._-]/', '', strtolower($_FILES['featured_image']['name']));
            $dest     = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $dest)) {
                $img = '/uploads/' . $filename;
            } else {
                $errors[] = 'Failed to upload image.';
            }
        }
    }

    if (empty($errors)) {
        if ($id) {
            $stmt = $pdo->prepare("
                UPDATE posts SET title=?, slug=?, excerpt=?, content=?, category_id=?,
                featured_image=?, status=? WHERE id=?
            ");
            $stmt->execute([$title, $slug, $excerpt, $content, $cat_id, $img ?: null, $status, $id]);
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO posts (title, slug, excerpt, content, category_id, featured_image, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$title, $slug, $excerpt, $content, $cat_id, $img ?: null, $status]);
            $id = (int)$pdo->lastInsertId();
        }
        // Reload
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $post    = $stmt->fetch();
        $success = true;
    }
}
?>
<?php include 'admin-header.php'; ?>

<div class="admin-page-header">
    <div>
        <h1><?= $id ? 'Edit Article' : 'New Article' ?></h1>
        <?php if ($id && ($post['status'] ?? '') === 'published'): ?>
        <a href="/post.php?slug=<?= e($post['slug']) ?>" target="_blank" style="font-size:.85rem;color:var(--a-teal)">View live ↗</a>
        <?php endif; ?>
    </div>
    <a href="/admin/" class="btn-admin btn-admin-ghost">← Dashboard</a>
</div>

<?php if ($success): ?>
<div class="alert alert-success">Article saved successfully.</div>
<?php endif; ?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-error"><?= e($err) ?></div>
<?php endforeach; ?>

<form method="post" enctype="multipart/form-data" class="post-form">
    <div class="post-form-main">
        <!-- Title -->
        <div class="field">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" required
                   value="<?= e($post['title'] ?? '') ?>"
                   placeholder="Article title"
                   oninput="autoSlug(this.value)">
        </div>

        <!-- Slug -->
        <div class="field">
            <label for="slug">URL slug</label>
            <div class="slug-preview">
                <span class="slug-prefix"><?= e(SITE_URL) ?>/post.php?slug=</span>
                <input type="text" id="slug" name="slug"
                       value="<?= e($post['slug'] ?? '') ?>" placeholder="auto-generated">
            </div>
        </div>

        <!-- Excerpt -->
        <div class="field">
            <label for="excerpt">Excerpt <span class="field-hint">Short summary shown in article listings</span></label>
            <textarea id="excerpt" name="excerpt" rows="3"
                      placeholder="Optional short description..."><?= e($post['excerpt'] ?? '') ?></textarea>
        </div>

        <!-- Content -->
        <div class="field">
            <label for="content">Content *</label>
            <textarea id="content" name="content" rows="24"><?= e($post['content'] ?? '') ?></textarea>
        </div>
    </div>

    <div class="post-form-sidebar">

        <!-- Publish -->
        <div class="admin-card">
            <h3>Publish</h3>
            <div class="field">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="draft" <?= ($post['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= ($post['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn-admin btn-admin-primary" style="width:100%">Save article</button>
        </div>

        <!-- Category -->
        <div class="admin-card">
            <h3>Category</h3>
            <div class="field">
                <select name="category_id">
                    <option value="">— No category —</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                        <?= ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                        <?= e($cat['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Featured image -->
        <div class="admin-card">
            <h3>Featured image</h3>
            <?php if (!empty($post['featured_image'])): ?>
            <img src="<?= e($post['featured_image']) ?>" alt="Current image"
                 style="width:100%;border-radius:6px;margin-bottom:.75rem;object-fit:cover;max-height:160px">
            <?php endif; ?>
            <div class="field">
                <input type="file" name="featured_image" accept="image/*" id="img-upload">
                <label for="img-upload" class="btn-admin btn-admin-ghost" style="display:inline-block;cursor:pointer;margin-top:.4rem">
                    Choose image
                </label>
                <span id="img-name" style="font-size:.8rem;color:var(--a-muted);display:block;margin-top:.3rem"></span>
            </div>
        </div>

    </div>
</form>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#content',
    height: 580,
    plugins: 'lists link image table code fullscreen preview',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | table | code fullscreen preview',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; line-height: 1.7; max-width: 780px; margin: 1rem auto; }',
    branding: false,
    promotion: false,
    images_upload_url: '/admin/upload-image.php',
    automatic_uploads: true,
    file_picker_types: 'image',
});

// Auto-generate slug from title
function autoSlug(val) {
    const slugEl = document.getElementById('slug');
    if (slugEl && !slugEl.dataset.manual) {
        slugEl.value = val.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g,'')
            .replace(/[\s-]+/g,'-')
            .replace(/^-|-$/g,'');
    }
}
document.getElementById('slug')?.addEventListener('input', function() {
    this.dataset.manual = '1';
});

// Show selected filename
document.getElementById('img-upload')?.addEventListener('change', function() {
    document.getElementById('img-name').textContent = this.files[0]?.name || '';
});
</script>

<?php include 'admin-footer.php'; ?>
