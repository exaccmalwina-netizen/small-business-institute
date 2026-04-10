<?php
/**
 * WordPress bootstrap dla REST API.
 * Ten plik zastępuje nadpisany wp index.php.
 */
define('WP_USE_THEMES', true);
require(dirname(__FILE__) . '/wp-blog-header.php');
