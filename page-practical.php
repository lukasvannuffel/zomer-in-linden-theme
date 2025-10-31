<?php
/**
 * Template Name: Practical Info Page
 * 
 * Displays practical information about the festival
 * 
 * @package Zomer_in_Linden
 */


get_header(); ?>

<script>document.body.classList.add('force-header-fill');</script>


<div class="practical-page">
    <div class="container">
        
        <!-- Page Header -->
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>
        
        <!-- Main Content (Gutenberg blocks for general info) -->
        <div class="practical-content gutenberg-content">
            <?php
            while (have_posts()): the_post();
                the_content();
            endwhile;
            ?>
        </div>
        
        <!-- FAQ Accordion Section -->
        <?php
        // Query all FAQs
        $faq_query = new WP_Query(array(
            'post_type' => 'faq',
            'posts_per_page' => -1,
            'orderby' => 'menu_order date',
            'order' => 'ASC'
        ));
        
        if ($faq_query->have_posts()): ?>
            <section class="faq-section">
                <h2 class="faq-main-title">Veelgestelde Vragen</h2>
                
                <div class="faq-accordion">
                    <?php 
                    $faq_index = 0;
                    while ($faq_query->have_posts()): $faq_query->the_post();
                        $faq_index++;
                        $faq_category = get_field('faq_category');
                        $category_label = '';
                        
                        // Get category label
                        switch($faq_category) {
                            case 'general':
                                $category_label = 'Algemeen';
                                break;
                            case 'tickets':
                                $category_label = 'Tickets & Prijzen';
                                break;
                            case 'location':
                                $category_label = 'Locatie & Parkeren';
                                break;
                            case 'food':
                                $category_label = 'Eten & Drinken';
                                break;
                            case 'accessibility':
                                $category_label = 'Toegankelijkheid';
                                break;
                            case 'other':
                                $category_label = 'Overige';
                                break;
                            default:
                                $category_label = '';
                        }
                        ?>
                        
                        <div class="faq-item" data-category="<?php echo esc_attr($faq_category); ?>">
                            <button 
                                class="faq-question" 
                                aria-expanded="false" 
                                aria-controls="faq-answer-<?php echo $faq_index; ?>"
                                data-faq-toggle>
                                <?php if ($category_label): ?>
                                    <span class="faq-category-badge"><?php echo esc_html($category_label); ?></span>
                                <?php endif; ?>
                                <span class="faq-question-text"><?php the_title(); ?></span>
                                <span class="faq-icon" aria-hidden="true">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                                    </svg>
                                </span>
                            </button>
                            
                            <div 
                                class="faq-answer" 
                                id="faq-answer-<?php echo $faq_index; ?>"
                                aria-hidden="true">
                                <div class="faq-answer-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                </div>
                
                <?php wp_reset_postdata(); ?>
            </section>
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>