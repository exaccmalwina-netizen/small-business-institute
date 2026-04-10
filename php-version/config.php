<?php
// config.php
// Konfiguracja Twojej aplikacji Headless WordPress

// Zmień poniższy adres na adres API Twojego WordPressa.
// (zwykle po prostu domena WordPressa z dodanym /wp-json/wp/v2)

define('WP_API_URL', 'https://indigo-turkey-747101.hostingersite.com/wp-json/wp/v2');

// Pomocnicza funkcja do wyświetlania bezpiecznego tekstu
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}
