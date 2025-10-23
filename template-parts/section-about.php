<?php
/**
 * About Section
 * 
 * Information about the festival
 * 
 * @package Zomer_in_Linden
 */

$about_title = get_field('about_title');
$about_content = get_field('about_content');
$about_image = get_field('about_image');
?>

<section id="about" class="about-section section-padding">
    <div class="container">
        <div class="about-grid">
            
            <!-- About Content -->
            <div class="about-content">
                <?php if ($about_title): ?>
                    <h2 class="section-title"><?php echo esc_html($about_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($about_content): ?>
                    <div class="about-text">
                        <?php echo wp_kses_post($about_content); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- About Image -->
            <?php if ($about_image): ?>
                <div class="about-image">
                    <img src="<?php echo esc_url($about_image['url']); ?>" 
                         alt="<?php echo esc_attr($about_title); ?>">
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>