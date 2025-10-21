<?php
/**
 * Zomer in Linden Theme Functions
 * 
 * This file contains all theme setup, enqueues, and custom functionality.
 * @package Zomer_In_Linden
 * @since 1.0.0
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 * Runs after WordPress initialization
 */
function zomer_theme_setup() {
    
    // Add theme support for various WordPress features
    add_theme_support('title-tag');                    // Let WordPress manage document title
    add_theme_support('post-thumbnails');              // Enable featured images
    add_theme_support('html5', array(                  // Enable HTML5 markup
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    add_theme_support('responsive-embeds');            // Responsive embedded content
    add_theme_support('custom-logo');                  // Allow logo upload in Customizer
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'zomer-in-linden'),
        'footer'  => __('Footer Menu', 'zomer-in-linden'),
    ));
    
    // Set content width (for embedded content)
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'zomer_theme_setup');

/**
 * Enqueue Styles and Scripts
 * Loads CSS and JavaScript files properly
 */
function zomer_enqueue_assets() {
    
    // Get theme version (useful for cache busting during development)
    $theme_version = wp_get_theme()->get('Version');
    
    // Enqueue main stylesheet
    wp_enqueue_style(
        'zomer-main-style',                           // Handle name
        get_template_directory_uri() . '/assets/css/main.css',  // File path
        array(),                                      // Dependencies (none)
        $theme_version,                               // Version number
        'all'                                         // Media type
    );
    
    // Enqueue main JavaScript file
    wp_enqueue_script(
        'zomer-main-script',                          // Handle name
        get_template_directory_uri() . '/assets/js/main.js',    // File path
        array(),                                      // Dependencies (none - or add 'jquery' if needed)
        $theme_version,                               // Version number
        true                                          // Load in footer (true = better performance)
    );
    
    // Pass data from PHP to JavaScript (optional - useful for AJAX)
    wp_localize_script('zomer-main-script', 'zomerData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('zomer-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'zomer_enqueue_assets');

/**
 * Include additional files
 * Keep functions.php clean by separating concerns
 */
require_once get_template_directory() . '/inc/custom-functions.php';

// Include ACF fields only if ACF is active
if (function_exists('acf_add_local_field_group')) {
    require_once get_template_directory() . '/inc/acf-fields.php';
}

/**
 * Register Custom Post Type for Artists (for Line-up page)
 * Makes it easy to manage artist entries separately
 */
function zomer_register_artists_cpt() {
    
    $labels = array(
        'name'               => 'Artists',
        'singular_name'      => 'Artist',
        'menu_name'          => 'Artists',
        'add_new'            => 'Add New Artist',
        'add_new_item'       => 'Add New Artist',
        'edit_item'          => 'Edit Artist',
        'new_item'           => 'New Artist',
        'view_item'          => 'View Artist',
        'search_items'       => 'Search Artists',
        'not_found'          => 'No artists found',
        'not_found_in_trash' => 'No artists found in trash',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,             // We'll display artists on line-up page
        'publicly_queryable'  => false,             // No single artist pages
        'show_ui'             => true,              // Show in admin
        'show_in_menu'        => true,
        'show_in_rest'        => true,              // Enable Gutenberg editor
        'menu_icon'           => 'dashicons-star-filled',
        'supports'            => array('title', 'editor', 'thumbnail'),
        'rewrite'             => false,
    );
    
    register_post_type('artist', $args);
}
add_action('init', 'zomer_register_artists_cpt');

/**
 * Add ACF Options Page for Global Settings
 * Allows editing of content that appears site-wide
 */
if (function_exists('acf_add_options_page')) {
    
    acf_add_options_page(array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-admin-settings',
        'redirect'   => false
    ));
}

?>