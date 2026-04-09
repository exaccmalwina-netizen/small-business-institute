/* SBI — Main JS */

// Mobile nav
const navToggle = document.getElementById('nav-toggle');
const siteNav   = document.getElementById('site-nav');
if (navToggle) {
    navToggle.addEventListener('click', () => {
        siteNav.classList.toggle('open');
    });
}

// Newsletter popup
const POPUP_KEY   = 'sbi_newsletter_seen';
const POPUP_DELAY = 8000; // ms before auto-show

function openNewsletter() {
    document.getElementById('newsletter-overlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeNewsletter() {
    document.getElementById('newsletter-overlay').classList.remove('active');
    document.body.style.overflow = '';
    sessionStorage.setItem(POPUP_KEY, '1');
}

// Close on overlay click
const overlay = document.getElementById('newsletter-overlay');
if (overlay) {
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closeNewsletter();
    });
    // Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeNewsletter();
    });
    // Auto-show after delay (once per session)
    if (!sessionStorage.getItem(POPUP_KEY)) {
        setTimeout(openNewsletter, POPUP_DELAY);
    }
}

// Expose globally for onclick attributes
window.openNewsletter  = openNewsletter;
window.closeNewsletter = closeNewsletter;
