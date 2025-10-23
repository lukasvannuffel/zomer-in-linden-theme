<?php
/**
 * Header Template
 * 
 * Displays the header section including:
 * - HTML head with meta tags
 * - Navigation menu with hamburger toggle
 * - Logo
 * 
 * @package Zomer_in_Linden
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content link for accessibility -->
<a class="skip-link screen-reader-text" href="#main-content">
    <?php esc_html_e('Skip to content', 'zomer-in-linden'); ?>
</a>

<!-- Main Header -->
<header id="site-header" class="site-header" role="banner">
    <div class="header-container">
        <div class="header-inner">
            
            <!-- Logo -->
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link">
                    <?php 
                    $logo = get_field('site_logo', 'option');
                    
                    if ($logo): ?>
                        <img src="<?php echo esc_url($logo['url']); ?>" 
                             alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                             class="site-logo">
                    <?php else: ?>
                        <!-- Fallback: Text logo -->
                        <div class="text-logo">
                            <span class="logo-zomer">ZOMER</span>
                            <span class="logo-in">IN</span>
                            <span class="logo-linden">LINDEN</span>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <nav id="desktop-menu" class="desktop-navigation" role="navigation" aria-label="Primary Menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => false
                ));
                ?>
                
                <!-- Social Icons (Desktop Only) -->
                <div class="header-social">
                    <?php 
                    $facebook = get_field('social_facebook', 'option');
                    $instagram = get_field('social_instagram', 'option');
                    $tiktok = get_field('social_tiktok', 'option');
                    
                    if ($facebook): ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    <?php endif;
                    
                    if ($instagram): ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    <?php endif;
                    
                    if ($tiktok): ?>
                        <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle menu">
                <span class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
            
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="mobile-menu" aria-hidden="true">
    <div class="mobile-menu-inner">
        
        <!-- Close Button (in top right) -->
        <button class="mobile-menu-close" aria-label="Close menu">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </button>
        
        <!-- Mobile Navigation -->
        <nav class="mobile-navigation" role="navigation" aria-label="Mobile Menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'menu_class' => 'mobile-nav-menu',
                'container' => false,
                'fallback_cb' => false
            ));
            ?>
        </nav>
        
        <!-- Scroll indicator at bottom -->
        <div class="mobile-menu-scroll">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
            </svg>
        </div>
    </div>
</div>

<!-- Main Content Wrapper -->
<main id="main-content" class="site-main" role="main">