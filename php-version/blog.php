<?php
require_once __DIR__ . '/includes/wp-api.php';

$page_title = 'Resources & Articles | Small Business Institute';

$categoryFilter = $_GET['cat'] ?? null;
$per_page = 100; // pobieramy do 100 postów by działało w listingu
$posts = get_wp_posts($per_page, $categoryFilter);

$categoryColors = [
    'employment'          => '#0284c7',
    'business-management' => '#7c3aed',
    'compliance'          => '#059669',
    'insurance'           => '#1e293b',
    'new-technologies'    => '#7c3aed',
    'success-stories'     => '#f59e0b',
    'failure-stories'     => '#e11d48',
];

$pageTitles = [
    'employment'          => 'Employment Articles',
    'business-management' => 'Business Management Articles',
    'compliance'          => 'Compliance Articles',
    'insurance'           => 'Insurance Articles',
    'new-technologies'    => 'New Technologies Articles',
    'success-stories'     => 'Success Stories',
    'failure-stories'     => 'Failure Stories',
];

$displayTitle = 'Resources & Articles';
if ($categoryFilter && isset($pageTitles[$categoryFilter])) {
    $displayTitle = $pageTitles[$categoryFilter];
}

include __DIR__ . '/includes/header.php';
?>

<main>
    <div class="blog-header" style="padding: 5rem 0 4rem; background: var(--navy); color: var(--white); border-bottom: 2px solid var(--accent); text-align: center;">
        <div class="container">
            <h1 id="page-title" style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; color: var(--white); margin-bottom: 1rem; letter-spacing: -0.02em;"><?= e($displayTitle) ?></h1>
            <p class="hero-subtitle" style="font-size: 1.25rem; color: rgba(255,255,255,0.8); max-width: 700px; margin: 0 auto; line-height: 1.6;">Plain-English guides for Australian small business owners.</p>
        </div>
    </div>

    <div class="section" style="padding: 4rem 0 6rem; background: var(--light);">
        <div class="container">
            <!-- Category filter pills -->
            <div class="category-pills" style="display: flex; flex-wrap: wrap; gap: 0.6rem; margin-bottom: 3rem; justify-content: center;">
                <a href="/blog.php" class="pill <?= !$categoryFilter ? 'active' : '' ?>" style="--pill-color: var(--navy); background: <?= !$categoryFilter ? 'var(--navy)' : 'transparent' ?>; color: <?= !$categoryFilter ? '#fff' : 'var(--navy-mid)' ?>; text-decoration:none; border: 1.5px solid <?= !$categoryFilter ? 'var(--navy)' : 'var(--border)' ?>; padding: 0.45rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; font-family: var(--font-body);">All</a>
                
                <?php foreach($categoryColors as $slug => $color): 
                    $name = $pageTitles[$slug] ?? $slug;
                    $name = str_replace(' Articles', '', $name);
                    $isActive = $categoryFilter === $slug;
                ?>
                    <a href="/blog.php?cat=<?= e($slug) ?>" class="pill <?= $isActive ? 'active' : '' ?>" style="--pill-color: <?= $color ?>; background: <?= $isActive ? $color : 'transparent' ?>; color: <?= $isActive ? '#fff' : 'var(--navy-mid)' ?>; text-decoration:none; border: 1.5px solid <?= $isActive ? $color : 'var(--border)' ?>; padding: 0.45rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; font-family: var(--font-body);">
                        <?= e($name) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (empty($posts)): ?>
                <div class="empty-state" style="text-align: center; padding: 5rem 2rem; background: var(--white); border-radius: var(--radius-xl); border: 2px dashed var(--border); color: var(--muted);">
                    <p class="empty-title" style="font-size: 1.2rem; font-weight: 700; color: var(--navy); margin-bottom: 0.5rem;">No articles yet.</p>
                    <p>Check back soon — content is on its way.</p>
                </div>
            <?php else: ?>
                <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.75rem;">
                    <?php foreach($posts as $post): 
                        $slug = $post['slug'];
                        $title = $post['title']['rendered'];
                        $excerpt = substr(strip_tags($post['excerpt']['rendered']), 0, 160) . '…';
                        $dateStr = date('j F Y', strtotime($post['date']));
                        
                        $terms = $post['_embedded']['wp:term'][0] ?? [];
                        $category = $terms[0]['slug'] ?? 'uncategorized';
                        $categoryName = $terms[0]['name'] ?? 'Uncategorized';
                        $accentColor = $categoryColors[$category] ?? '#0284c7';
                    ?>
                        <article class="post-card" style="background: var(--white); border-radius: var(--radius-lg); border: 1.5px solid var(--border); overflow: hidden; display: flex; flex-direction: column; transition: all 0.25s ease;">
                            <div class="card-stripe" style="height: 4px; background: <?= $accentColor ?>;"></div>
                            <div class="post-card-body" style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                                <div class="post-card-meta" style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.82rem; margin-bottom: 1rem;">
                                    <span class="post-cat-badge" style="background: <?= $accentColor ?>20; color: <?= $accentColor ?>; padding: 0.2rem 0.6rem; border-radius: 20px; font-weight: 700; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em;"><?= e($categoryName) ?></span>
                                    <span class="post-date" style="color: var(--muted);"><?= $dateStr ?></span>
                                </div>
                                <h3 style="font-size: 1.2rem; margin: 0 0 0.75rem; line-height: 1.35; font-family: var(--font-heading);">
                                    <a href="/post.php?slug=<?= e($slug) ?>" style="color: var(--navy); text-decoration:none;"><?= $title ?></a>
                                </h3>
                                <p style="color: var(--muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;"><?= $excerpt ?></p>
                                <div class="post-card-footer" style="border-top: 1px solid var(--border); padding-top: 1rem; margin-top: auto;">
                                    <a href="/post.php?slug=<?= e($slug) ?>" class="read-more" style="font-weight: 700; font-size: 0.875rem; color: <?= $accentColor ?>; text-decoration:none;">Read article →</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
.post-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-4px);
    border-color: transparent !important;
}
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
