<?php
require_once __DIR__ . '/includes/wp-api.php';

$page_title = 'Small Business Institute Australia';

// Pobierz 3 najnowsze posty z sekcji Latest Articles
$posts = get_wp_posts(3);

$categoryColors = [
    'employment'          => '#0284c7',
    'business-management' => '#7c3aed',
    'compliance'          => '#059669',
    'insurance'           => '#1e293b',
    'new-technologies'    => '#7c3aed',
    'success-stories'     => '#f59e0b',
    'failure-stories'     => '#e11d48',
];

include __DIR__ . '/includes/header.php';
?>

<main>
    <!-- Bright Premium Hero -->
    <section class="hero">
        <div class="hero-bg" style="background-image: url('/assets/images/hero_bg.png')"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container hero-content-inner">
                <div class="hero-text-block">
                    <div class="hero-proof">
                        <div class="avatar-stack">
                            <div class="avatar" style="z-index: 5;"><img src="/assets/images/avatar_1.jpg" alt="JD"></div>
                            <div class="avatar" style="z-index: 4;"><img src="/assets/images/avatar_2.jpg" alt="HJ"></div>
                            <div class="avatar" style="z-index: 3;"><img src="/assets/images/avatar_3.jpg" alt="PI"></div>
                            <div class="avatar" style="z-index: 2;"><img src="/assets/images/avatar_4.jpg" alt="KD"></div>
                            <div class="avatar" style="z-index: 1;"><img src="/assets/images/avatar_5.jpg" alt="LD"></div>
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
                        Free Resources
                        <span class="btn-hero-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="hero-marquee-wrapper">
            <div class="stats-marquee-container">
                <div class="stats-marquee-track">
                    <?php for($i=0; $i<4; $i++): ?>
                    <div class="stats-marquee-inner" <?= $i>0 ? 'aria-hidden="true"' : '' ?>>
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
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Safe Space Strip -->
    <section class="section-sm">
        <div class="container text-center max-w-3xl">
            <h2 style="font-size: clamp(2rem, 4vw, 2.75rem); color: var(--navy); font-weight: 800; margin-bottom: 1.5rem; letter-spacing: -0.02em; line-height: 1.15;">
                Finally, a <span style="position: relative; display: inline-block;">
                    <span style="position: relative; z-index: 1; color: var(--accent);">safe space</span>
                    <span style="position: absolute; bottom: 4px; left: -2px; right: -4px; height: 12px; background: color-mix(in srgb, var(--accent) 25%, transparent); z-index: 0; transform: rotate(-1deg);"></span>
                </span>
                for founders
            </h2>
            <p style="font-size: 1.25rem; color: var(--navy-mid); line-height: 1.6; margin-bottom: 2rem;">
                No jargon, no gatekeeping. Just clear, actionable advice from people who have actually built and scaled businesses in Australia. We break down the complex stuff so you can focus on what you do best: running your business.
            </p>
        </div>
    </section>

    <!-- Topic Guides (Hardcoded equivalents) -->
    <section class="section-sm section-alt">
        <div class="container">
            <div class="section-header-row" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem">
                <h2>Browse by topic</h2>
                <a href="/blog.php" class="btn btn-outline" style="border: 1.5px solid var(--border); padding: 0.65rem 1.25rem; border-radius: var(--radius); text-decoration: none; color: var(--navy); font-weight: 600;">All articles</a>
            </div>
            
            <div class="guides-strip" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <a href="/blog.php?cat=employment" class="guide-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); border: 1.5px solid var(--border); display: flex; gap: 1.25rem; text-decoration: none; color: var(--text); transition: all 0.2s;">
                    <span class="guide-icon" style="color: var(--accent); width: 28px; height:28px;"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></span>
                    <div>
                        <h4 style="margin: 0 0 0.5rem; color: var(--navy); font-size: 1.1rem;">Employment</h4>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--muted);">Hiring, contracts, and employer obligations.</p>
                    </div>
                </a>
                <a href="/blog.php?cat=compliance" class="guide-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); border: 1.5px solid var(--border); display: flex; gap: 1.25rem; text-decoration: none; color: var(--text); transition: all 0.2s;">
                    <span class="guide-icon" style="color: var(--accent); width: 28px; height:28px;"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                    <div>
                        <h4 style="margin: 0 0 0.5rem; color: var(--navy); font-size: 1.1rem;">Compliance</h4>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--muted);">Tax, reporting, and staying on the right side of the ATO.</p>
                    </div>
                </a>
                <a href="/blog.php?cat=business-management" class="guide-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); border: 1.5px solid var(--border); display: flex; gap: 1.25rem; text-decoration: none; color: var(--text); transition: all 0.2s;">
                    <span class="guide-icon" style="color: var(--accent); width: 28px; height:28px;"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg></span>
                    <div>
                        <h4 style="margin: 0 0 0.5rem; color: var(--navy); font-size: 1.1rem;">Business Management</h4>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--muted);">Running a business day to day.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Articles from WordPress PHP API -->
    <section class="section" style="padding: 6rem 0; background: var(--light);">
        <div class="container">
            <div class="section-header-row" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3.5rem;">
                <div>
                    <span style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--accent); margin-bottom: 0.6rem;">Latest Resources</span>
                    <h2 style="font-size: clamp(1.75rem, 3.5vw, 2.5rem); font-weight: 800; color: var(--navy); line-height: 1.18; margin: 0;">Guides fresh from<br><em style="font-style: normal; color: var(--accent);">our editorial team</em></h2>
                </div>
                <a href="/blog.php" class="btn btn-outline" style="display: inline-block; border: 1.5px solid var(--border); background: transparent; color: var(--navy); padding: 0.65rem 1.25rem; border-radius: var(--radius); font-size: 0.9rem; font-weight: 600; text-decoration: none;">All articles →</a>
            </div>

            <?php if (empty($posts)): ?>
                <div style="text-align: center; padding: 5rem 2rem; background: var(--white); border-radius: var(--radius-xl); border: 2px dashed var(--border);">
                    <div style="font-size: 3rem; margin-bottom: 1.25rem;">✍️</div>
                    <p style="font-size: 1.35rem; font-weight: 700; color: var(--navy); margin-bottom: 0.5rem;">Articles coming soon</p>
                    <p style="color: var(--muted); margin-bottom: 1.75rem;">Subscribe to be the first to know.</p>
                    <button class="btn-primary" id="latest-newsletter-trigger">Subscribe free</button>
                </div>
            <?php else: ?>
                <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.75rem;">
                    <?php foreach($posts as $i => $post): 
                        $slug = $post['slug'];
                        $title = $post['title']['rendered'];
                        $excerpt = substr(strip_tags($post['excerpt']['rendered']), 0, 160) . '…';
                        $dateStr = date('d M Y', strtotime($post['date']));
                        
                        $terms = $post['_embedded']['wp:term'][0] ?? [];
                        $category = $terms[0]['slug'] ?? 'uncategorized';
                        $categoryName = $terms[0]['name'] ?? 'Uncategorized';
                        $accentColor = $categoryColors[$category] ?? '#0284c7';
                    ?>
                    <article class="post-card" style="background: var(--white); border-radius: var(--radius-lg); border: 1.5px solid var(--border); overflow: hidden; display: flex; flex-direction: column; transition: all 0.28s ease;">
                        <div class="card-top-stripe" style="height: 4px; background: <?= $accentColor ?>; transition: height 0.28s ease;"></div>
                        <div class="post-card-body" style="padding: 1.75rem; display: flex; flex-direction: column; flex-grow: 1;">
                            <div class="post-card-meta" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <span class="post-cat-badge" style="padding: 0.25rem 0.65rem; border-radius: 20px; font-weight: 700; font-size: 0.72rem; text-transform: uppercase; background: <?= $accentColor ?>20; color: <?= $accentColor ?>"><?= e($categoryName) ?></span>
                                <span class="post-date" style="color: var(--muted); font-size: 0.8rem;"><?= $dateStr ?></span>
                            </div>
                            <h3 style="font-size: 1.25rem; margin: 0 0 0.85rem; line-height: 1.3; font-family: var(--font-heading);">
                                <a href="/post.php?slug=<?= e($slug) ?>" style="color: var(--navy); text-decoration: none;"><?= $title ?></a>
                            </h3>
                            <p style="color: var(--muted); font-size: 0.9rem; line-height: 1.65; margin-bottom: 1.5rem; flex-grow: 1;"><?= $excerpt ?></p>
                            <div class="post-card-footer" style="display: flex; align-items: center; justify-content: space-between; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: auto;">
                                <a href="/post.php?slug=<?= e($slug) ?>" class="read-more" style="color: <?= $accentColor ?>; font-weight: 700; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.4rem; text-decoration: none;">
                                    Read article
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                                <span class="read-time" style="font-size: 0.78rem; color: var(--muted);">5 min read</span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- About Strip -->
    <section class="section-sm">
        <div class="container">
            <div class="about-strip" style="background: var(--navy); border-radius: var(--radius-xl); padding: 4rem; color: var(--white); display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; overflow: hidden; position: relative;">
                <div style="position: relative; z-index: 2;">
                    <h2 style="font-size: clamp(2rem, 3.5vw, 2.75rem); color: var(--white); margin-bottom: 1.25rem; font-weight: 800; letter-spacing: -0.02em;">Who we are</h2>
                    <p style="color: rgba(255,255,255,0.85); font-size: 1.15rem; line-height: 1.7; margin-bottom: 2rem;">The Small Business Institute is a not-for-profit organisation dedicated to supporting small business owners and independent contractors across Australia. We advocate, educate, and share what no one else takes the time to explain properly.</p>
                    <a href="/about.php" class="btn btn-ghost" style="display: inline-block; background: rgba(255,255,255,0.1); color: var(--white); padding: 0.85rem 1.75rem; border-radius: var(--radius); font-weight: 600; text-decoration: none;">Learn more about SBI</a>
                </div>
                <div class="about-strip-right" style="position: relative; z-index: 2;">
                    <div class="stat-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="stat">
                            <span class="stat-num" style="display: block; font-size: 3.5rem; font-weight: 800; font-family: var(--font-heading); color: var(--accent); line-height: 1; margin-bottom: 0.5rem; letter-spacing: -0.02em;">2.5M+</span>
                            <span class="stat-label" style="font-size: 0.95rem; color: rgba(255,255,255,0.8); line-height: 1.4; font-weight: 500;">small businesses in Australia</span>
                        </div>
                        <div class="stat">
                            <span class="stat-num" style="display: block; font-size: 3.5rem; font-weight: 800; font-family: var(--font-heading); color: var(--accent); line-height: 1; margin-bottom: 0.5rem; letter-spacing: -0.02em;">97%</span>
                            <span class="stat-label" style="font-size: 0.95rem; color: rgba(255,255,255,0.8); line-height: 1.4; font-weight: 500;">of all Australian businesses</span>
                        </div>
                    </div>
                </div>
                <div style="position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(3,105,161,0.4) 0%, transparent 70%); right: -200px; top: -200px; z-index: 1;"></div>
            </div>
        </div>
    </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
