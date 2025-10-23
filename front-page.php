<?php
/**
 * Front Page Template
 * 
 * This is the main landing page with all sections in one page
 * Sections: Hero, About, Partners, Contact
 * 
 * @package Zomer_in_Linden
 */

get_header(); ?>

<div class="front-page-wrapper">
    
    <!-- Hero Section -->
    <?php get_template_part('template-parts/section', 'hero'); ?>
    
    <!-- About Section -->
    <?php get_template_part('template-parts/section', 'about'); ?>
    
    <!-- Partners Section -->
    <?php get_template_part('template-parts/section', 'partners'); ?>
    
    <!-- Contact Section -->
    <?php get_template_part('template-parts/section', 'contact'); ?>
    
</div>

<?php get_footer(); ?>