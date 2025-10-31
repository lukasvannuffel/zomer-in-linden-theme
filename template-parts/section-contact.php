<?php
/**
 * Contact Section
 * 
 * Contact form with Google Maps integration
 * 
 * @package Zomer_in_Linden
 */

$contact_title = get_field('contact_title');
$contact_subtitle = get_field('contact_subtitle');
$contact_email = zil_get_setting('contact_email');
$contact_phone = zil_get_setting('contact_phone');
?>

<section id="contact" class="contact-section section-padding">
    <div class="container">
        
        <!-- Section Header -->
        <header class="section-header">
            <?php if ($contact_title): ?>
                <h2 class="section-title">
                    <?php echo esc_html($contact_title); ?>
                </h2>
            <?php else: ?>
                <h2 class="section-title">Contacteer Ons</h2>
            <?php endif; ?>
            
            <?php if ($contact_subtitle): ?>
                <p class="section-subtitle"><?php echo esc_html($contact_subtitle); ?></p>
            <?php else: ?>
                <p class="section-subtitle">
                    Bij vragen, vul onderstaand formulier in en we nemen<br>
                    zo snel mogelijk contact met u op.
                </p>
            <?php endif; ?>
        </header>
        

            


                    <!-- Contact Grid: Map + Form -->
        <div class="contact-grid-layout">            <!-- Right Column: Contact Form -->
            <div class="contact-right">
                <div class="contact-form-container">
                    <?php 
                    // Display Contact Form 7
                    echo do_shortcode('[contact-form-7 id="10cf1bd" title="Contact form - Zomer in Linden"]'); 
                    ?>
                </div>
            </div>
            
            <!-- Left Column: Google Maps + Contact Info -->
            <div class="contact-left">
                
                <!-- Google Maps Embed -->
                <div class="contact-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2516.510163529314!2d4.764568776850105!3d50.89577575519951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c167ace1bcb129%3A0xd0a1d6ce4029b876!2sZomer%20in%20Linden!5e0!3m2!1snl!2sbe!4v1761660120520!5m2!1snl!2sbe"
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Zomer in Linden Location">
                    </iframe>
                </div>
                
                <!-- Contact Information Below Map -->
                <div class="contact-info-box">
                    <?php if ($contact_email || zil_get_setting('contact_email')): 
                        $display_email = $contact_email ? $contact_email : zil_get_setting('contact_email');
                    ?>
                        <div class="contact-info-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            <a href="mailto:<?php echo esc_attr($display_email); ?>">
                                <?php echo esc_html($display_email); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($contact_phone || zil_get_setting('contact_phone')): 
                        $display_phone = $contact_phone ? $contact_phone : zil_get_setting('contact_phone');
                    ?>
                        <div class="contact-info-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            <a href="tel:<?php echo esc_attr($display_phone); ?>">
                                <?php echo esc_html($display_phone); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Social Media Links -->
                    <div class="contact-social-links">
                        <?php 
                        $facebook = zil_get_setting('social_facebook');
                        $instagram = zil_get_setting('social_instagram');
                        $tiktok = zil_get_setting('social_tiktok');
                        
                        if ($facebook): ?>
                            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        <?php endif;
                        
                        if ($instagram): ?>
                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        <?php endif;
                        
                        if ($tiktok): ?>
                            <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="social-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>