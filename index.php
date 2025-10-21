<?php
/**
 * Fallback Template
 * 
 * This template is used when no more specific template is available.
 * In our case, specific templates (front-page.php, page-lineup.php, etc.) 
 * will handle most pages, but this acts as a safety net.
 * 
 * @package Zomer_In_Linden
 */

get_header(); ?>

<main id="main-content" class="site-main" role="main">
    
    <?php if (have_posts()) : ?>
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                
            </article>
            
        <?php endwhile; ?>
        
    <?php else : ?>
        
        <!-- No content found -->
        <article class="no-content">
            <h1>Niets gevonden</h1>
            <p>Sorry, deze pagina bestaat niet.</p>
        </article>
        
    <?php endif; ?>
    
</main>

<?php get_footer(); ?>