<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($metaDesc ?? 'Practical support, guides and resources for small business owners and independent contractors in Australia.') ?>">
    <title><?= e(($pageTitle ?? '') ? $pageTitle . ' — ' . SITE_NAME : SITE_NAME) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="/" class="logo">
            <span class="logo-mark">SBI</span>
            <span class="logo-text">Small Business Institute</span>
        </a>
        <nav class="site-nav" id="site-nav">
            <a href="/">Home</a>
            <a href="/blog.php">Resources</a>
            <a href="/about.php">About</a>
            <button class="btn btn-primary nav-cta" onclick="openNewsletter()">Newsletter</button>
        </nav>
        <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
