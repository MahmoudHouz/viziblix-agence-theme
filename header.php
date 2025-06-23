
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- SEO Meta Tags -->
    <?php if (is_front_page()) : ?>
        <meta name="description" content="Viziblix - Votre agence digitale de confiance pour transformer votre présence en ligne et générer des résultats concrets. Services de création web, marketing digital et SEO.">
        <meta name="keywords" content="agence digitale, création site web, marketing digital, SEO, référencement, Paris">
        <meta property="og:title" content="Viziblix - Agence Digitale de Confiance">
        <meta property="og:description" content="Transformez votre présence digitale avec Viziblix. Création de sites web, marketing digital et stratégies sur mesure.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
        <meta name="twitter:card" content="summary_large_image">
    <?php endif; ?>
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts with font-display: swap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content link for accessibility -->
<a class="screen-reader-text" href="#main">Aller au contenu principal</a>

<header class="site-header" role="banner">
    <div class="container">
        <div class="header-content">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="Retour à l'accueil Viziblix">
                Viziblix
            </a>
            
            <nav class="main-nav" id="main-nav" role="navigation" aria-label="Navigation principale">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'viziblix_fallback_menu',
                ));
                ?>
            </nav>
            
            <button 
                class="mobile-menu-toggle" 
                id="mobile-menu-toggle" 
                aria-label="Ouvrir le menu de navigation"
                aria-expanded="false"
                aria-controls="main-nav"
            >
                <span aria-hidden="true">☰</span>
            </button>
        </div>
    </div>
</header>

<main id="main" role="main">
