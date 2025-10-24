<?php
/**
 * Footer Template
 * 
 * Displays the footer section including:
 * - Footer widgets
 * - Copyright information
 * - Social media links
 * 
 * @package Zomer_in_Linden
 */
?>

</main><!-- #main-content -->

<!-- Site Footer -->
<footer id="site-footer" class="site-footer" role="contentinfo">
    <div class="container">
        
        <!-- Footer Top Section -->
        <div class="footer-top">
            <div class="footer-grid">
                
<!-- About Column -->
<div class="footer-column">
    <h3><?php esc_html_e('About Zomer in Linden', 'zomer-in-linden'); ?></h3>
    <?php 
    $footer_about = zil_get_setting('footer_about');
    if ($footer_about): 
        echo wp_kses_post($footer_about);
    else:
        echo '<p>' . esc_html__('Your premier summer festival experience.', 'zomer-in-linden') . '</p>';
    endif; 
    ?>
</div>

<!-- Contact Column -->
<div class="footer-column">
    <h3><?php esc_html_e('Contact', 'zomer-in-linden'); ?></h3>
    <?php 
    $email = zil_get_setting('contact_email');
    $phone = zil_get_setting('contact_phone');
    $address = zil_get_setting('contact_address');
    
    if ($email): ?>
        <p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
    <?php endif;
    
    if ($phone): ?>
        <p><strong>Phone:</strong> <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></p>
    <?php endif;
    
    if ($address): ?>
        <p><strong>Address:</strong> <?php echo esc_html($address); ?></p>
    <?php endif; ?>
</div>

<!-- Social Media Column -->
<div class="footer-column">
    <h3><?php esc_html_e('Follow Us', 'zomer-in-linden'); ?></h3>
    <div class="social-links">
        <?php 
        $facebook = zil_get_setting('social_facebook');
        $instagram = zil_get_setting('social_instagram');
        $twitter = zil_get_setting('social_twitter');
        $tiktok = zil_get_setting('social_tiktok');
        
        if ($facebook): ?>
            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
        <?php endif;
        
        if ($instagram): ?>
            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
        <?php endif;
        
        if ($tiktok): ?>
            <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
</div>
                
            </div>
        </div>
        
        <!-- Footer Bottom Section -->
        <div class="footer-bottom">
            <p class="copyright">
                &copy; <?php echo date('Y'); ?> 
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
                <?php esc_html_e(' - All rights reserved', 'zomer-in-linden'); ?>
            </p>
        </div>
        
    </div>
</footer>

<?php wp_footer(); // Essential WordPress hook ?>
</body>
</html>