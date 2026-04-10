<?php
// includes/wp-api.php
require_once __DIR__ . '/../config.php';

function fetch_wp_api($endpoint) {
    // Add missing trailing slash to WP_API_URL if needed
    $base_url = rtrim(WP_API_URL, '/');
    $url = $base_url . $endpoint;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // useful for local testing
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200 || !$response) {
        return null;
    }

    return json_decode($response, true);
}

function get_wp_posts($per_page = 10, $category_slug = null) {
    global $wp_categories;

    $endpoint = "/posts?_embed&per_page={$per_page}&status=publish";
    
    if ($category_slug) {
        $cats_response = fetch_wp_api("/categories?slug={$category_slug}");
        if ($cats_response && count($cats_response) > 0) {
            $cat_id = $cats_response[0]['id'];
            $endpoint .= "&categories={$cat_id}";
        }
    }

    $posts = fetch_wp_api($endpoint);
    return $posts ?: [];
}

function get_wp_post_by_slug($slug) {
    if (!$slug) return null;
    
    $encoded_slug = urlencode($slug);
    $response = fetch_wp_api("/posts?_embed&slug={$encoded_slug}&status=publish");
    
    if ($response && count($response) > 0) {
        return $response[0];
    }
    
    return null;
}
