
<!-- Newsletter Popup -->
<div class="newsletter-overlay" id="newsletter-overlay" role="dialog" aria-modal="true" aria-label="Newsletter signup">
    <div class="newsletter-modal">
        <button class="newsletter-close" onclick="closeNewsletter()" aria-label="Close">&times;</button>
        <div class="newsletter-content">
            <p class="newsletter-eyebrow">Stay informed</p>
            <h2>Practical insights for small business owners</h2>
            <p class="newsletter-sub">No fluff. Just useful guides, updates and resources — straight to your inbox.</p>
            <?php if (MAILCHIMP_FORM_ACTION): ?>
            <form action="<?= e(MAILCHIMP_FORM_ACTION) ?>" method="post" target="_blank" class="newsletter-form" novalidate>
                <input type="email" name="EMAIL" placeholder="Your email address" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
                <div style="position:absolute;left:-5000px" aria-hidden="true">
                    <input type="text" name="b_REPLACE_WITH_MAILCHIMP_HIDDEN" tabindex="-1" value="">
                </div>
            </form>
            <?php else: ?>
            <form class="newsletter-form" onsubmit="return false;">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
            <p style="font-size:0.75rem;color:var(--muted);margin-top:0.5rem">⚙ Add your Mailchimp form action URL to config.php to activate</p>
            <?php endif; ?>
            <p class="newsletter-privacy">No spam. Unsubscribe anytime.</p>
        </div>
    </div>
</div>

<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-brand">
            <a href="/" class="logo">
                <span class="logo-mark">SBI</span>
                <span class="logo-text">Small Business Institute</span>
            </a>
            <p>Supporting small business and independent contractors across Australia.</p>
        </div>
        <div class="footer-links">
            <div>
                <strong>Resources</strong>
                <a href="/blog.php?cat=employment">Employment</a>
                <a href="/blog.php?cat=business-management">Business Management</a>
                <a href="/blog.php?cat=compliance">Compliance</a>
                <a href="/blog.php?cat=insurance">Insurance</a>
                <a href="/blog.php?cat=new-technologies">New Technologies</a>
            </div>
            <div>
                <strong>Institute</strong>
                <a href="/about.php">About Us</a>
                <a href="/blog.php">All Articles</a>
                <a href="javascript:void(0)" onclick="openNewsletter()">Newsletter</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Small Business Institute. Not-for-profit organisation.</p>
            <p>Information on this site is general in nature. Always seek professional advice for your specific situation.</p>
        </div>
    </div>
</footer>

<script src="/assets/js/main.js"></script>
</body>
</html>
