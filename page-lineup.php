<?php
/**
 * Template Name: Line-up Page
 * 
 * Displays all artists/performers for the festival
 * 
 * @package Zomer_in_Linden
 */


get_header(); ?>

<script>document.body.classList.add('force-header-fill');</script>


<div class="lineup-page">
    <div class="container">
        
        <!-- Page Header -->
        <header class="page-header">
            <h1 class="page-title">
                <?php 
                $lineup_title = get_field('lineup_title');
                echo $lineup_title ? esc_html($lineup_title) : esc_html__('Line-up 2026', 'zomer-in-linden'); 
                ?>
            </h1>
            <?php if (get_field('lineup_intro_text')): ?>
                <div class="page-intro">
                    <?php echo wp_kses_post(get_field('lineup_intro_text')); ?>
                </div>
            <?php endif; ?>
        </header>
        
        <!-- Artists Grid -->
        <div class="artists-grid">
            <?php
            // Query all artists
            $artists_query = new WP_Query(array(
                'post_type' => 'artist',
                'posts_per_page' => -1, // Get all artists
                'orderby' => 'menu_order', // Allow manual ordering
                'order' => 'ASC'
            ));
            
            if ($artists_query->have_posts()):
                while ($artists_query->have_posts()): $artists_query->the_post();
                    
                    // Get ACF fields for each artist
                    $artist_genre = get_field('artist_genre');
                    $artist_time = get_field('artist_performance_time');
                    $artist_stage = get_field('artist_stage');
                    ?>
                    
                    <div class="artist-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="artist-image">
                                <?php the_post_thumbnail('artist-photo'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="artist-content">
                            <h2 class="artist-name"><?php the_title(); ?></h2>
                            
                            <?php if ($artist_genre): ?>
                                <p class="artist-genre"><?php echo esc_html($artist_genre); ?></p>
                            <?php endif; ?>
                            
                            <div class="artist-meta">
                                <?php if ($artist_time): ?>
                                    <span class="artist-time">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
                                        </svg>
                                        <?php echo esc_html($artist_time); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if ($artist_stage): ?>
                                    <span class="artist-stage">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                        </svg>
                                        <?php echo esc_html($artist_stage); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (get_the_content()): ?>
                                <div class="artist-bio">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <p><?php esc_html_e('No artists announced yet. Stay tuned!', 'zomer-in-linden'); ?></p>
            <?php endif; ?>
        </div>
        
    </div>
</div>

<?php get_footer(); ?>