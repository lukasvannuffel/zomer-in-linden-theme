<?php
/**
 * Index Template
 * 
 * This is the fallback template used when no more specific template is available
 * 
 * @package Zomer_in_Linden
 */

get_header(); ?>

<div class="container">
    <div class="content-wrapper">
        
        <?php if (have_posts()): ?>
            
            <?php while (have_posts()): the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                
            <?php endwhile; ?>
            
        <?php else: ?>
            
            <p><?php esc_html_e('No content found', 'zomer-in-linden'); ?></p>
            
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>