<?php
require_once 'config.php';
require_once 'includes/helpers.php';
$pageTitle = 'About Us';
$metaDesc  = 'The Small Business Institute is a not-for-profit organisation supporting small business owners and independent contractors across Australia.';
?>
<?php include 'includes/header.php'; ?>

<div class="about-hero">
    <div class="container">
        <h1>About the Small Business Institute</h1>
        <p>A not-for-profit organisation dedicated to supporting small business and independent contractors across Australia.</p>
    </div>
</div>

<div class="about-content">
    <h2>Our mission</h2>
    <p>Content coming soon. The Small Business Institute is building something worth reading — check back shortly.</p>

    <h2>What we do</h2>
    <p>We share practical, plain-English information on starting and running a business in Australia — covering employment, compliance, tax, insurance, and more.</p>

    <h2>Who we are for</h2>
    <p>Small business owners. Independent contractors. Freelancers. Anyone navigating the reality of running their own business without a corporate support structure behind them.</p>

    <div style="margin-top:2.5rem;padding:2rem;background:var(--teal-lt);border-radius:var(--radius-lg);border:1px solid var(--border)">
        <h3 style="color:var(--teal)">Stay connected</h3>
        <p style="margin:.6rem 0 1.25rem;color:#333">Subscribe to the newsletter for practical updates, guides, and resources — no spam, ever.</p>
        <button class="btn btn-primary" onclick="openNewsletter()">Subscribe to our newsletter</button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
