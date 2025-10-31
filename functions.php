<?php
/**
 * Zomer in Linden Theme Functions
 * 
 * This file contains all the theme's core functionality including:
 * - Enqueuing CSS and JavaScript files
 * - Theme support features
 * - Custom post types and taxonomies
 * - ACF field registration
 * 
 * @package Zomer_in_Linden
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 * 
 * Registers theme support for various WordPress features
 */
function zil_theme_setup() {
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    
    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');
    
    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'zomer-in-linden'),
        'footer-menu' => __('Footer Menu', 'zomer-in-linden')
    ));
}
add_action('after_setup_theme', 'zil_theme_setup');

/**
 * Enqueue Styles and Scripts
 * 
 * Properly loads CSS and JavaScript files in the correct order
 */
function zil_enqueue_assets() {
    
    // Main stylesheet (required by WordPress)
    wp_enqueue_style(
        'zil-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Custom CSS file
    wp_enqueue_style(
        'zil-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array('zil-style'),
        wp_get_theme()->get('Version')
    );
    
    // Main JavaScript file (loaded in footer for better performance)
    wp_enqueue_script(
        'zil-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(), // No dependencies
        wp_get_theme()->get('Version'),
        true // Load in footer
    );
    
    // Pass data from PHP to JavaScript (useful for AJAX)
    wp_localize_script('zil-main-script', 'zilData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('zil-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'zil_enqueue_assets');

/**
 * Register Custom Image Sizes
 * 
 * Create specific image sizes for partners, artists, etc.
 */
function zil_custom_image_sizes() {
    add_image_size('partner-logo', 300, 150, true); // For partner logos
    add_image_size('artist-photo', 600, 400, true); // For artist photos
    add_image_size('hero-image', 1920, 1080, true); // For hero sections
}
add_action('after_setup_theme', 'zil_custom_image_sizes');

/**
 * Custom Post Type: Artists
 * 
 * Creates a custom post type for managing festival artists/performers
 */
function zil_register_artists_post_type() {
    
    $labels = array(
        'name' => 'Artists',
        'singular_name' => 'Artist',
        'menu_name' => 'Artists',
        'add_new' => 'Add New Artist',
        'add_new_item' => 'Add New Artist',
        'edit_item' => 'Edit Artist',
        'new_item' => 'New Artist',
        'view_item' => 'View Artist',
        'search_items' => 'Search Artists',
        'not_found' => 'No artists found',
        'not_found_in_trash' => 'No artists found in trash'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // Enable Gutenberg editor
        'menu_icon' => 'dashicons-album',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'artist')
    );
    
    register_post_type('artist', $args);
}
add_action('init', 'zil_register_artists_post_type');

/**
 * Custom Post Type: Partners
 * 
 * Creates a custom post type for managing festival partners/sponsors
 */
function zil_register_partners_post_type() {
    
    $labels = array(
        'name' => 'Partners',
        'singular_name' => 'Partner',
        'menu_name' => 'Partners',
        'add_new' => 'Add New Partner',
        'add_new_item' => 'Add New Partner',
        'edit_item' => 'Edit Partner',
        'new_item' => 'New Partner',
        'view_item' => 'View Partner',
        'search_items' => 'Search Partners',
        'not_found' => 'No partners found',
        'not_found_in_trash' => 'No partners found in trash'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false, // Partners don't need individual pages
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'thumbnail'),
        'rewrite' => array('slug' => 'partner')
    );
    
    register_post_type('partner', $args);
}
add_action('init', 'zil_register_partners_post_type');


/**
 * Custom Post Type: FAQs
 * 
 * Creates a custom post type for managing FAQ items
 */
function zil_register_faq_post_type() {
    
    $labels = array(
        'name' => 'FAQs',
        'singular_name' => 'FAQ',
        'menu_name' => 'FAQs',
        'add_new' => 'Add New FAQ',
        'add_new_item' => 'Add New FAQ',
        'edit_item' => 'Edit FAQ',
        'new_item' => 'New FAQ',
        'view_item' => 'View FAQ',
        'search_items' => 'Search FAQs',
        'not_found' => 'No FAQs found',
        'not_found_in_trash' => 'No FAQs found in trash'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false, // FAQs don't need individual pages
        'show_in_menu' => true,
        'show_in_rest' => true, // Enable Gutenberg editor
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array('title', 'editor'), // THIS IS THE KEY LINE - enables content editor
        'rewrite' => array('slug' => 'faq'),
        'capability_type' => 'post',
        'show_ui' => true,
        'menu_position' => 25
    );
    
    register_post_type('faq', $args);
}
add_action('init', 'zil_register_faq_post_type');

/**
 * Theme Customizer Settings
 * 
 * Registers all theme settings in the WordPress Customizer
 * This replaces ACF Options Page (which requires Pro)
 */
function zil_customize_register($wp_customize) {
    
    /* ============================================
       SECTION 1: SITE IDENTITY (Logo & Branding)
       ============================================ */
    
    // Logo is already built into WordPress under "Site Identity"
    // We'll add a custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    /* ============================================
       SECTION 2: CONTACT INFORMATION
       ============================================ */
    
    $wp_customize->add_section('zil_contact_info', array(
        'title'       => __('Contact Information', 'zomer-in-linden'),
        'description' => __('Manage contact details displayed on the website', 'zomer-in-linden'),
        'priority'    => 30,
    ));
    
    // Contact Email
    $wp_customize->add_setting('zil_contact_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_contact_email', array(
        'label'       => __('Contact Email', 'zomer-in-linden'),
        'description' => __('Main contact email address', 'zomer-in-linden'),
        'section'     => 'zil_contact_info',
        'type'        => 'email',
    ));
    
    // Contact Phone
    $wp_customize->add_setting('zil_contact_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_contact_phone', array(
        'label'       => __('Contact Phone', 'zomer-in-linden'),
        'description' => __('Contact phone number', 'zomer-in-linden'),
        'section'     => 'zil_contact_info',
        'type'        => 'text',
    ));
    
    // Contact Address
    $wp_customize->add_setting('zil_contact_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_contact_address', array(
        'label'       => __('Contact Address', 'zomer-in-linden'),
        'description' => __('Physical address of the festival', 'zomer-in-linden'),
        'section'     => 'zil_contact_info',
        'type'        => 'textarea',
    ));
    
    /* ============================================
       SECTION 3: SOCIAL MEDIA LINKS
       ============================================ */
    
    $wp_customize->add_section('zil_social_media', array(
        'title'       => __('Social Media', 'zomer-in-linden'),
        'description' => __('Add your social media profile links', 'zomer-in-linden'),
        'priority'    => 31,
    ));
    
    // Facebook
    $wp_customize->add_setting('zil_social_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_social_facebook', array(
        'label'       => __('Facebook URL', 'zomer-in-linden'),
        'description' => __('Full URL to your Facebook page', 'zomer-in-linden'),
        'section'     => 'zil_social_media',
        'type'        => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('zil_social_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_social_instagram', array(
        'label'       => __('Instagram URL', 'zomer-in-linden'),
        'description' => __('Full URL to your Instagram profile', 'zomer-in-linden'),
        'section'     => 'zil_social_media',
        'type'        => 'url',
    ));
    
    // Twitter/X
    $wp_customize->add_setting('zil_social_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_social_twitter', array(
        'label'       => __('Twitter/X URL', 'zomer-in-linden'),
        'description' => __('Full URL to your Twitter/X profile', 'zomer-in-linden'),
        'section'     => 'zil_social_media',
        'type'        => 'url',
    ));
    
    // TikTok
    $wp_customize->add_setting('zil_social_tiktok', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_social_tiktok', array(
        'label'       => __('TikTok URL', 'zomer-in-linden'),
        'description' => __('Full URL to your TikTok profile', 'zomer-in-linden'),
        'section'     => 'zil_social_media',
        'type'        => 'url',
    ));
    
    /* ============================================
       SECTION 4: FOOTER SETTINGS
       ============================================ */
    
    $wp_customize->add_section('zil_footer_settings', array(
        'title'       => __('Footer Settings', 'zomer-in-linden'),
        'description' => __('Customize footer content', 'zomer-in-linden'),
        'priority'    => 32,
    ));
    
    // Footer About Text
    $wp_customize->add_setting('zil_footer_about', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('zil_footer_about', array(
        'label'       => __('Footer About Text', 'zomer-in-linden'),
        'description' => __('Short description about the festival for footer', 'zomer-in-linden'),
        'section'     => 'zil_footer_settings',
        'type'        => 'textarea',
    ));
    
}
add_action('customize_register', 'zil_customize_register');

/**
 * Helper function to get theme settings
 * Usage: zil_get_setting('contact_email')
 */
function zil_get_setting($setting_name) {
    return get_theme_mod('zil_' . $setting_name, '');
}

/**
 * Remove unnecessary WordPress features for cleaner admin
 */
function zil_remove_unnecessary_features() {
    // Remove posts (if you don't need a blog)
    // remove_menu_page('edit.php');
    
    // Remove comments (if not needed)
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'zil_remove_unnecessary_features');

/**
 * Custom excerpt length
 */
function zil_excerpt_length($length) {
    return 20; // Number of words
}
add_filter('excerpt_length', 'zil_excerpt_length');

/**
 * Security: Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');