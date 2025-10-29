<?php
/**
 * Template Name: Practical Info Page
 * 
 * Displays practical information about the festival
 * 
 * @package Zomer_in_Linden
 */

get_header(); ?>

<div class="practical-page">
    <div class="container">
        
        <!-- Page Header -->
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>
        
        <!-- Practical Info Sections -->
        <div class="practical-content">
            
            <?php
            // Check if we have repeater fields for practical info
            if (have_rows('practical_info_sections')):
                while (have_rows('practical_info_sections')): the_row();
                    $section_title = get_sub_field('section_title');
                    $section_content = get_sub_field('section_content');
                    $section_icon = get_sub_field('section_icon');
                    ?>
                    
                    <section class="practical-section">
                        <?php if ($section_icon): ?>
                            <div class="section-icon">
                                <img src="<?php echo esc_url($section_icon['url']); ?>" alt="<?php echo esc_attr($section_title); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <h2><?php echo esc_html($section_title); ?></h2>
                        <div class="section-content">
                            <?php echo wp_kses_post($section_content); ?>
                        </div>
                    </section>
                    
                <?php
                endwhile;
            else:
                // Fallback to regular page content
                ?>
                <div class="default-content">
                    <?php
                    while (have_posts()): the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>
            
        </div>
        
        <!-- FAQ Section (Optional) -->
        <?php if (have_rows('faq_items')): ?>
            <section class="faq-section">
                <h2><?php esc_html_e('Frequently Asked Questions', 'zomer-in-linden'); ?></h2>
                <div class="faq-list">
                    <?php
                    while (have_rows('faq_items')): the_row();
                        $question = get_sub_field('question');
                        $answer = get_sub_field('answer');
                        ?>
                        <div class="faq-item">
                            <h3 class="faq-question"><?php echo esc_html($question); ?></h3>
                            <div class="faq-answer">
                                <?php echo wp_kses_post($answer); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>