    <footer class="site-footer">
        <div class="container footer-container">
            <div class="footer-brand">
                <div class="logo">
                    <svg class="logo-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="9" fill="#0284c7"/>
                        <text x="20" y="28" text-anchor="middle" font-family="'Sora', 'Inter', sans-serif" font-size="22" font-weight="800" fill="white" letter-spacing="-1">S</text>
                    </svg>
                    <div class="logo-text-wrap" style="color:var(--white)">
                        <span class="logo-name" style="color:var(--white)">Small Business Institute</span>
                        <span class="logo-sub" style="color:rgba(255,255,255,0.6)">Australia</span>
                    </div>
                </div>
                <p class="footer-desc">Supporting Australian enterprise with plain-English guides, actionable advice, and a community of peers.</p>
            </div>
            
            <div class="footer-links-group">
                <h3>Resources</h3>
                <ul>
                    <li><a href="/blog.php">All Articles</a></li>
                    <li><a href="/blog.php?cat=business-management">Business Management</a></li>
                    <li><a href="/blog.php?cat=compliance">Compliance</a></li>
                </ul>
            </div>
            
            <div class="footer-links-group">
                <h3>Institute</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <p>&copy; <?= date('Y') ?> Small Business Institute Australia. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Newsletter Overlay Modal -->
    <div id="newsletter-overlay" class="overlay" aria-hidden="true" style="display:none;">
        <div class="overlay-backdrop"></div>
        <div class="newsletter-modal">
            <button class="close-overlay" aria-label="Close modal">&times;</button>
            <div class="modal-body">
                <div class="modal-icon">💌</div>
                <h3 class="modal-title">Join the SBI Community</h3>
                <p class="modal-desc">Get the weekly no-fluff email that helps 200+ Australian business owners stay ahead of the curve.</p>
                <form class="newsletter-form" id="newsletter-form">
                    <div class="form-group">
                        <input type="text" placeholder="First name" required class="form-input">
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email address" required class="form-input">
                    </div>
                    <button type="submit" class="btn-primary w-full" style="height:48px">Subscribe Free</button>
                    <p class="form-promise">We respect your inbox. No spam, ever.</p>
                </form>
                <div id="newsletter-success" style="display:none; text-align:center; padding: 2rem 0;">
                    <h4 style="color:var(--green); font-size:1.2rem; margin-bottom:0.5rem">You're in!</h4>
                    <p>Check your inbox to confirm your subscription.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Some basic JS needed for the header/footer modals -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('newsletter-overlay');
            const closeBtn = document.querySelector('.close-overlay');
            const backdrop = document.querySelector('.overlay-backdrop');
            
            function closeModal() {
                if(modal) {
                    modal.style.display = 'none';
                    modal.setAttribute('aria-hidden', 'true');
                }
            }

            if(closeBtn) closeBtn.addEventListener('click', closeModal);
            if(backdrop) backdrop.addEventListener('click', closeModal);

            const form = document.getElementById('newsletter-form');
            if(form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    form.style.display = 'none';
                    document.getElementById('newsletter-success').style.display = 'block';
                });
            }
        });
    </script>
</body>
</html>
