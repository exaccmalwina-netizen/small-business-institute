<?php
require_once __DIR__ . '/includes/wp-api.php';

$slug = $_GET['slug'] ?? null;
$post = get_wp_post_by_slug($slug);

if (!$post) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Article not found</h1><p><a href='/blog.php'>Back to blog</a></p>";
    exit;
}

$title = $post['title']['rendered'];
$contentHTML = $post['content']['rendered'];
$dateStr = date('j F Y', strtotime($post['date']));

// Extract category and author safely
$terms = $post['_embedded']['wp:term'][0] ?? [];
$categorySlug = $terms[0]['slug'] ?? 'uncategorized';
$categoryName = $terms[0]['name'] ?? 'Uncategorized';
$author = $post['_embedded']['author'][0]['name'] ?? 'SBI Editorial Team';

$page_title = "{$title} | Small Business Institute";
include __DIR__ . '/includes/header.php';
?>

<main class="article-wrapper" style="background: var(--card-bg); padding: 4rem 0 6rem;">
    <article class="prose-container" style="max-width: 800px; margin: 0 auto; padding: 0 1.25rem;">
        <header class="article-header" style="margin-bottom: 3rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border);">
            <div class="article-meta" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <a href="/blog.php?cat=<?= e($categorySlug) ?>" class="post-cat-badge" style="background: var(--accent-lt); color: var(--accent); padding: 0.35rem 0.75rem; border-radius: 4px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; text-decoration: none;"><?= e($categoryName) ?></a>
                <span class="post-date" style="color: var(--muted); font-size: 0.95rem;"><?= $dateStr ?></span>
            </div>
            <h1 style="font-size: clamp(2.25rem, 5vw, 3.5rem); font-weight: 800; color: var(--navy); line-height: 1.15; letter-spacing: -0.02em; margin-bottom: 1.5rem;"><?= $title ?></h1>
            <p class="article-author" style="color: var(--navy-mid); font-weight: 600; font-size: 1.05rem;">By <?= e($author) ?></p>
        </header>

        <div class="prose" style="font-size: 1.15rem; line-height: 1.8; color: var(--text);">
            <?= $contentHTML ?>
        </div>

        <div class="article-footer" style="margin-top: 4rem; padding-top: 3rem; border-top: 1px dashed var(--border);">
            <div class="newsletter-inline" style="padding: 2.5rem; background: var(--off-white); border-radius: var(--radius-lg); border: 1px solid var(--border); text-align: center;">
                <h3 style="color: var(--navy); font-size: 1.5rem; margin-bottom: 0.75rem; font-weight: 800;">Was this helpful?</h3>
                <p style="color: var(--navy-mid); font-size: 1.05rem; margin-bottom: 1.5rem;">Subscribe to our newsletter for more no-fluff guides.</p>
                <button class="btn-primary" id="article-newsletter-trigger">Subscribe now</button>
            </div>
        </div>
    </article>
</main>

<style>
.post-cat-badge:hover {
    background: #bae6fd !important;
}
/* Prose specific styles equivalent to Astro */
.prose h2 { font-size: 2rem; color: var(--navy); margin: 3rem 0 1.25rem; font-weight: 700; line-height: 1.3; }
.prose h3 { font-size: 1.5rem; color: var(--navy); margin: 2rem 0 1rem; font-weight: 600; }
.prose p { margin-bottom: 1.5rem; }
.prose ul, .prose ol { margin-bottom: 1.5rem; padding-left: 1.5rem; }
.prose li { margin-bottom: 0.5rem; }
.prose strong { color: var(--navy); }
.prose a { color: var(--accent); text-decoration: underline; }
.prose blockquote { border-left: 4px solid var(--accent); padding-left: 1.25rem; color: var(--navy-mid); font-style: italic; margin: 2rem 0; }
</style>

<script>
    const trigger = document.getElementById('article-newsletter-trigger');
    const modal = document.getElementById('newsletter-overlay');
    if (trigger && modal) {
        trigger.addEventListener('click', () => {
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
        });
    }
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
