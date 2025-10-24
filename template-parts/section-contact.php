




















<!-- Contact Info -->
<div class="contact-info">
    <h3><?php esc_html_e('Get in Touch', 'zomer-in-linden'); ?></h3>
    
    <?php 
    $contact_email = zil_get_setting('contact_email');
    $contact_phone = zil_get_setting('contact_phone');
    
    if ($contact_email): ?>
        <div class="contact-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
            <a href="mailto:<?php echo esc_attr($contact_email); ?>">
                <?php echo esc_html($contact_email); ?>
            </a>
        </div>
    <?php endif;
    
    if ($contact_phone): ?>
        <div class="contact-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
            </svg>
            <a href="tel:<?php echo esc_attr($contact_phone); ?>">
                <?php echo esc_html($contact_phone); ?>
            </a>
        </div>
    <?php endif; ?>
</div>