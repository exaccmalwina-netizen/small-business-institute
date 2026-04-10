<?php
$page_title = $page_title ?? 'Small Business Institute Australia';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?></title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <meta name="description" content="Plain-English guides, tools, and resources for Australian small business owners.">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <!-- Logo -->
            <a href="/" class="logo">
                <svg class="logo-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="9" fill="#0284c7"/>
                    <text x="20" y="28" text-anchor="middle" font-family="'Sora', 'Inter', sans-serif" font-size="22" font-weight="800" fill="white" letter-spacing="-1">S</text>
                </svg>
                <div class="logo-text-wrap">
                    <span class="logo-name">Small Business Institute</span>
                    <span class="logo-sub">Australia</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="site-nav">
                <a href="/blog.php">Resources</a>
                <a href="#">About Us</a>
                <button class="btn-primary" id="header-join-trigger" style="font-family:inherit;">Join SBI</button>
            </nav>
        </div>
    </header>
