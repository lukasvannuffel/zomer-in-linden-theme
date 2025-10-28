<?php
/**
 * Partners Section
 * 
 * Display all festival partners/sponsors
 * 
 * @package Zomer_in_Linden
 */

$partners_title = get_field('partners_title');
?>

<section id="partners" class="partners-section section-padding">
    <div class="container">
        
        <!-- Section Header -->
        <header class="section-header">
            <h2 class="section-title">
                <?php echo $partners_title ? esc_html($partners_title) : esc_html__('Our Partners', 'zomer-in-linden'); ?>
            </h2>
        </header>
        
        <!-- Partners Grid -->
        <div class="partners-grid">
            <?php
            $partners_query = new WP_Query(array(
                'post_type' => 'partner',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            
            if ($partners_query->have_posts()):
                while ($partners_query->have_posts()): $partners_query->the_post();
                    $partner_website = get_field('partner_website');
                    ?>
                    
                    <div class="partner-item">
                        <?php if ($partner_website): ?>
                            <a href="<?php echo esc_url($partner_website); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="partner-link">
                        <?php endif; ?>
                        
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('partner-logo', array('class' => 'partner-logo')); ?>
                        <?php else: ?>
                            <span class="partner-name"><?php the_title(); ?></span>
                        <?php endif; ?>
                        
                        <?php if ($partner_website): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
    </div>
</section>