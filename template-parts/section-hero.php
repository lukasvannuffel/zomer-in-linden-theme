<?php
/**
 * Hero Section - Zomer in Linden
 * 
 * Full-screen hero with video/image background and centered content
 * 
 * @package Zomer_in_Linden
 */

// Get ACF fields
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_cta_primary_text = get_field('hero_cta_primary_text');
$hero_cta_primary_link = get_field('hero_cta_primary_link');
$hero_cta_secondary_text = get_field('hero_cta_secondary_text');
$hero_cta_secondary_link = get_field('hero_cta_secondary_link');
$hero_background_type = get_field('hero_background_type');
$hero_background_image = get_field('hero_background_image');
$hero_background_video = get_field('hero_background_video');
?>

<section id="home" class="hero-section">
    
    <!-- Background Media -->
    <div class="hero-background">
        <?php if ($hero_background_type === 'video' && $hero_background_video): ?>
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($hero_background_video['url']); ?>" type="video/mp4">
            </video>
        <?php elseif ($hero_background_image): ?>
            <img src="<?php echo esc_url($hero_background_image['url']); ?>" 
                 alt="<?php echo esc_attr($hero_title); ?>" 
                 class="hero-image">
        <?php endif; ?>
        
        <!-- Purple/Blue gradient overlay -->
        <div class="hero-overlay"></div>
    </div>
    
    <!-- Hero Content - Centered -->
    <div class="hero-content">
        <div class="hero-content-inner">
            
            <?php if ($hero_title): ?>
                <h1 class="hero-title">
                    <?php echo esc_html($hero_title); ?>
                </h1>
            <?php endif; ?>
            
            <?php if ($hero_subtitle): ?>
                <p class="hero-subtitle">
                    <?php echo nl2br(esc_html($hero_subtitle)); ?>
                </p>
            <?php endif; ?>
            
            <!-- CTA Buttons -->
            <div class="hero-cta-buttons">
                <?php if ($hero_cta_primary_text && $hero_cta_primary_link): ?>
                    <a href="<?php echo esc_url($hero_cta_primary_link); ?>" 
                       class="btn btn-primary hero-btn">
                        <?php echo esc_html($hero_cta_primary_text); ?>
                    </a>
                <?php endif; ?>
                
                <?php if ($hero_cta_secondary_text && $hero_cta_secondary_link): ?>
                    <a href="<?php echo esc_url($hero_cta_secondary_link); ?>" 
                       class="btn btn-secondary hero-btn">
                        <?php echo esc_html($hero_cta_secondary_text); ?>
                    </a>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
    
    <!-- Scroll Indicator (Arrow Down) -->
    <div class="scroll-indicator">
        <a href="#about" aria-label="Scroll to next section">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
            </svg>
        </a>
    </div>
    
</section>