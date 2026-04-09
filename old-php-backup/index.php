<?php
require_once 'config.php';
require_once 'includes/helpers.php';

// Latest posts for hero
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, c.slug AS category_slug
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.status = 'published'
    ORDER BY p.created_at DESC
    LIMIT 7
");
$stmt->execute();
$posts = $stmt->fetchAll();

$featured  = $posts[0] ?? null;
$secondary = array_slice($posts, 1, 3);
$extra     = array_slice($posts, 4, 3);

$categories = getCategories($pdo);
?>
<?php include 'includes/header.php'; ?>

<!-- Bright Premium Hero -->
<section class="hero">
    <!-- Background Image with Overlay -->
    <div class="hero-bg" style="background-image: url('assets/images/hero_bg.png')"></div>
    <div class="hero-overlay"></div>
    
    <!-- Hero Main Content -->
    <div class="hero-content">
        <div class="container hero-content-inner">
            <div class="hero-text-block">
                <!-- Avatar Stack Above Headline -->
                <div class="hero-proof">
                    <div class="avatar-stack">
                        <div class="avatar" style="z-index: 5;"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=JD&backgroundColor=1e293b" alt="JD"></div>
                        <div class="avatar" style="z-index: 4;"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=HJ&backgroundColor=334155" alt="HJ"></div>
                        <div class="avatar" style="z-index: 3;"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=PI&backgroundColor=475569" alt="PI"></div>
                        <div class="avatar" style="z-index: 2;"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=KD&backgroundColor=64748b" alt="KD"></div>
                        <div class="avatar" style="z-index: 1;"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=LD&backgroundColor=94a3b8" alt="LD"></div>
                    </div>
                    <span class="proof-text">Trusted by 200+ Australian Businesses</span>
                </div>
                
                <h1 class="hero-headline">
                    We <span class="text-accent">think</span>, you <span class="text-accent">grow</span><br>
                    <span class="text-navy">— that's the deal</span>
                </h1>
                
                <p class="hero-subheadline">
                    We take your big ideas and turn them into clear, winning strategies. From setting up your company to scaling it worldwide, we're here every step of the way.
                </p>
                
                <a href="/blog.php" class="btn btn-hero">
                    Get Template
                    <span class="btn-hero-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Marquee Footer -->
    <div class="hero-marquee-wrapper">
        <div class="stats-marquee-container">
            <div class="stats-marquee-track">
                <!-- Group 1 -->
                <div class="stats-marquee-inner">
                    <div class="stat-item">
                        <span class="stat-val">$5M+</span>
                        <span class="stat-label">IN CLIENT REVENUE GENERATED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">200+</span>
                        <span class="stat-label">BUSINESSES LAUNCHED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">$500K+</span>
                        <span class="stat-label">SAVED IN OPERATIONAL COSTS</span>
                    </div>
                </div>
                <!-- Group 2 -->
                <div class="stats-marquee-inner" aria-hidden="true">
                    <div class="stat-item">
                        <span class="stat-val">$5M+</span>
                        <span class="stat-label">IN CLIENT REVENUE GENERATED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">200+</span>
                        <span class="stat-label">BUSINESSES LAUNCHED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">$500K+</span>
                        <span class="stat-label">SAVED IN OPERATIONAL COSTS</span>
                    </div>
                </div>
                <!-- Group 3 -->
                <div class="stats-marquee-inner" aria-hidden="true">
                    <div class="stat-item">
                        <span class="stat-val">$5M+</span>
                        <span class="stat-label">IN CLIENT REVENUE GENERATED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">200+</span>
                        <span class="stat-label">BUSINESSES LAUNCHED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">$500K+</span>
                        <span class="stat-label">SAVED IN OPERATIONAL COSTS</span>
                    </div>
                </div>
                <!-- Group 4 -->
                <div class="stats-marquee-inner" aria-hidden="true">
                    <div class="stat-item">
                        <span class="stat-val">$5M+</span>
                        <span class="stat-label">IN CLIENT REVENUE GENERATED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">200+</span>
                        <span class="stat-label">BUSINESSES LAUNCHED</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">$500K+</span>
                        <span class="stat-label">SAVED IN OPERATIONAL COSTS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Topic Guides Strip -->
<section class="section-sm section-alt">
    <div class="container">
        <div class="section-header-row">
            <h2>Browse by topic</h2>
            <a href="/blog.php" class="btn btn-outline">All articles</a>
        </div>
        <div class="guides-strip">
            <?php
            $icons = [
                'employment' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>', 'Hiring, contracts, and employer obligations.'],
                'business-management' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>', 'Running a business day to day.'],
                'compliance' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 'Tax, reporting, and staying on the right side of the ATO.'],
                'insurance' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path></svg>', 'Protecting yourself and your business.'],
                'new-technologies' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>', 'Tools and tech for modern small business.'],
                'success-stories' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>', 'Real stories from Australian business owners.'],
                'failure-stories' => ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>', 'What went wrong — and what we can learn.'],
            ];
            foreach ($categories as $cat):
                $info = $icons[$cat['slug']] ?? ['<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>', ''];
            ?>
            <a href="/blog.php?cat=<?= e($cat['slug']) ?>" class="guide-card">
                <span class="guide-icon" style="width:28px;height:28px;color:var(--navy-mid);display:inline-block;flex-shrink:0"><?= $info[0] ?></span>
                <div>
                    <h4><?= e($cat['name']) ?></h4>
                    <p><?= e($info[1]) ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="section">
    <div class="container">
        <div class="section-header-row">
            <div>
                <h2>Latest resources</h2>
                <p class="text-muted">Practical, no-fluff guides for Australian small business.</p>
            </div>
            <a href="/blog.php" class="btn btn-outline">View all</a>
        </div>

        <?php if (empty($posts)): ?>
        <div style="text-align:center;padding:4rem 0;color:var(--muted)">
            <p style="font-size:1.1rem">Articles coming soon.</p>
            <p>Subscribe to the newsletter to be first to know.</p>
            <button class="btn btn-primary mt-3" onclick="openNewsletter()">Subscribe</button>
        </div>
        <?php else: ?>
        <div class="posts-grid">
            <?php if ($featured): ?>
            <article class="post-card post-card-featured">
                <div class="post-card-image">
                    <?php if ($featured['featured_image']): ?>
                        <img src="<?= e($featured['featured_image']) ?>" alt="<?= e($featured['title']) ?>">
                    <?php else: ?>
                        <div class="post-card-image-placeholder"><span><svg style="width:48px;height:48px;color:var(--navy)" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg></span></div>
                    <?php endif; ?>
                </div>
                <div class="post-card-body">
                    <div class="post-card-meta">
                        <?php if ($featured['category_name']): ?>
                        <span class="post-cat-badge"><?= e($featured['category_name']) ?></span>
                        <?php endif; ?>
                        <span class="post-date"><?= formatDate($featured['created_at']) ?></span>
                    </div>
                    <h3><a href="/post.php?slug=<?= e($featured['slug']) ?>"><?= e($featured['title']) ?></a></h3>
                    <p><?= e(truncate($featured['excerpt'] ?: $featured['content'], 220)) ?></p>
                    <div class="post-card-footer">
                        <a href="/post.php?slug=<?= e($featured['slug']) ?>" class="read-more">Read article →</a>
                    </div>
                </div>
            </article>
            <?php endif; ?>

            <?php foreach ($secondary as $post): ?>
            <article class="post-card">
                <div class="post-card-image">
                    <?php if ($post['featured_image']): ?>
                        <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title']) ?>">
                    <?php else: ?>
                        <div class="post-card-image-placeholder"><span><svg style="width:40px;height:40px;color:rgba(15,39,68,.3)" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></span></div>
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
                    <p><?= e(truncate($post['excerpt'] ?: $post['content'], 140)) ?></p>
                    <div class="post-card-footer">
                        <a href="/post.php?slug=<?= e($post['slug']) ?>" class="read-more">Read article →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <?php if ($extra): ?>
        <div class="posts-grid mt-3" style="margin-top:1.5rem">
            <?php foreach ($extra as $post): ?>
            <article class="post-card">
                <div class="post-card-image">
                    <?php if ($post['featured_image']): ?>
                        <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title']) ?>">
                    <?php else: ?>
                        <div class="post-card-image-placeholder"><span><svg style="width:40px;height:40px;color:rgba(15,39,68,.3)" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></span></div>
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
                    <p><?= e(truncate($post['excerpt'] ?: $post['content'], 140)) ?></p>
                    <div class="post-card-footer">
                        <a href="/post.php?slug=<?= e($post['slug']) ?>" class="read-more">Read article →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- About Strip -->
<section class="section-sm">
    <div class="container">
        <div class="about-strip">
            <div>
                <h2>Who we are</h2>
                <p>The Small Business Institute is a not-for-profit organisation dedicated to supporting small business owners and independent contractors across Australia. We advocate, educate, and share what no one else takes the time to explain properly.</p>
                <a href="/about.php" class="btn btn-ghost">Learn more about SBI</a>
            </div>
            <div class="about-strip-right">
                <div class="stat-row">
                    <div class="stat">
                        <span class="stat-num">2.5M+</span>
                        <span class="stat-label">small businesses in Australia</span>
                    </div>
                    <div class="stat">
                        <span class="stat-num">97%</span>
                        <span class="stat-label">of all Australian businesses</span>
                    </div>
                </div>
                <p style="color:rgba(255,255,255,.6);font-size:.88rem;margin-top:1.5rem">Most run without a support network. We're here to change that.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
