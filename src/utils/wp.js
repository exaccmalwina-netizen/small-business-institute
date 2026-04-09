/**
 * WordPress REST API Helper
 * Fetches data from your Headless WordPress installation on Hostinger.
 *
 * Setup:
 *   1. Copy .env.example to .env
 *   2. Set WORDPRESS_API_URL to your WordPress site, e.g.:
 *      WORDPRESS_API_URL=https://businessinstitute.au/wp-json/wp/v2
 */

const wpUrl = (import.meta.env.WORDPRESS_API_URL || '').replace(/\/$/, '');

const isConfigured = wpUrl.length > 0 && !wpUrl.includes('your-hostinger');

if (!isConfigured) {
    console.warn('[wp.js] WORDPRESS_API_URL not set — falling back to local markdown files.');
}

/**
 * Fetch a list of posts from WordPress REST API.
 * Returns [] when WordPress is not yet configured.
 *
 * @param {number} perPage
 * @param {string|null} categorySlug  — filter by category slug (optional)
 */
export async function getPosts(perPage = 10, categorySlug = null) {
    if (!isConfigured) return [];

    try {
        let endpoint = `${wpUrl}/posts?_embed&per_page=${perPage}&status=publish`;

        if (categorySlug) {
            // Resolve slug → category ID first
            const catRes = await fetch(`${wpUrl}/categories?slug=${categorySlug}`);
            if (catRes.ok) {
                const cats = await catRes.json();
                if (cats.length > 0) {
                    endpoint += `&categories=${cats[0].id}`;
                }
            }
        }

        const res = await fetch(endpoint);
        if (!res.ok) throw new Error(`WordPress API error: ${res.status} ${res.statusText}`);

        return await res.json();
    } catch (err) {
        console.error('[wp.js] getPosts failed:', err);
        return [];
    }
}

/**
 * Fetch a single post by slug.
 * Returns null when WordPress is not configured or the post is not found.
 *
 * @param {string} slug
 */
export async function getPostBySlug(slug) {
    if (!isConfigured) return null;

    try {
        const res = await fetch(`${wpUrl}/posts?_embed&slug=${encodeURIComponent(slug)}&status=publish`);
        if (!res.ok) throw new Error(`WordPress API error: ${res.status} ${res.statusText}`);

        const data = await res.json();
        return data.length > 0 ? data[0] : null;
    } catch (err) {
        console.error('[wp.js] getPostBySlug failed:', err);
        return null;
    }
}

/**
 * Fetch all WordPress categories.
 * Useful for generating category pages or verifying slugs.
 */
export async function getCategories() {
    if (!isConfigured) return [];

    try {
        const res = await fetch(`${wpUrl}/categories?per_page=100&hide_empty=true`);
        if (!res.ok) throw new Error(`WordPress API error: ${res.status}`);
        return await res.json();
    } catch (err) {
        console.error('[wp.js] getCategories failed:', err);
        return [];
    }
}
