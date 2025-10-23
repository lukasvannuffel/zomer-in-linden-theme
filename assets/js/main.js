/**
 * Zomer in Linden - Main JavaScript
 * 
 * Table of Contents:
 * 1. Mobile Menu Toggle
 * 2. Smooth Scrolling
 * 3. Header Scroll Effect
 * 4. Contact Form Handling
 * 5. Image Lazy Loading
 * 6. Accessibility Enhancements
 */

(function() {
    'use strict';
    
    /* ============================================
       1. MOBILE MENU TOGGLE
       ============================================ */
    
    function initMobileMenu() {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const primaryNav = document.querySelector('.primary-navigation');
        const body = document.body;
        
        if (!menuToggle || !primaryNav) return;
        
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Toggle aria-expanded attribute
            this.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle active class on navigation
            primaryNav.classList.toggle('active');
            
            // Prevent body scroll when menu is open
            body.style.overflow = isExpanded ? '' : 'hidden';
        });
        
        // Close menu when clicking on a link
        const navLinks = primaryNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                primaryNav.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!primaryNav.contains(e.target) && !menuToggle.contains(e.target)) {
                primaryNav.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
            }
        });
        
        // Close menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                primaryNav.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
            }
        });
    }
    
    /* ============================================
       2. SMOOTH SCROLLING
       ============================================ */
    
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Skip if href is just '#'
                if (href === '#') return;
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                    const offsetPosition = targetPosition - headerHeight - 20;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Focus on the target for accessibility
                    target.focus();
                }
            });
        });
    }
    
    /* ============================================
       3. HEADER SCROLL EFFECT
       ============================================ */
    
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;
        
        let lastScroll = 0;
        
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            // Add 'scrolled' class when scrolled past 100px
            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        });
    }
    
    /* ============================================
       4. CONTACT FORM HANDLING
       ============================================ */
    
    function initContactForm() {
        const form = document.getElementById('contact-form');
        if (!form) return;
        
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formMessage = form.querySelector('.form-message');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;
            
            // Get form data
            const formData = new FormData(form);
            
            // Show loading state
            submitButton.textContent = 'Sending...';
            submitButton.disabled = true;
            formMessage.style.display = 'none';
            
            try {
                // Send form data via AJAX
                const response = await fetch(zilData.ajaxUrl, {
                    method: 'POST',
                    body: new URLSearchParams({
                        action: 'zil_contact_form',
                        nonce: zilData.nonce,
                        name: formData.get('name'),
                        email: formData.get('email'),
                        subject: formData.get('subject'),
                        message: formData.get('message')
                    })
                });
                
                const data = await response.json();
                
                // Show message
                formMessage.style.display = 'block';
                formMessage.className = 'form-message ' + (data.success ? 'success' : 'error');
                formMessage.textContent = data.data.message;
                
                // Reset form on success
                if (data.success) {
                    form.reset();
                }
                
            } catch (error) {
                formMessage.style.display = 'block';
                formMessage.className = 'form-message error';
                formMessage.textContent = 'An error occurred. Please try again.';
            } finally {
                // Restore button state
                submitButton.textContent = originalButtonText;
                submitButton.disabled = false;
            }
        });
    }
    
    /* ============================================
       5. IMAGE LAZY LOADING
       ============================================ */
    
    function initLazyLoading() {
        // Use native lazy loading if available
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src || img.src;
            });
        } else {
            // Fallback: Use Intersection Observer
            const images = document.querySelectorAll('img[data-src]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.add('loaded');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                
                images.forEach(img => imageObserver.observe(img));
            } else {
                // Ultimate fallback: Load all images immediately
                images.forEach(img => {
                    img.src = img.dataset.src;
                });
            }
        }
    }
    
    /* ============================================
       6. ACCESSIBILITY ENHANCEMENTS
       ============================================ */
    
    function initAccessibility() {
        // Add keyboard navigation for custom elements
        const interactiveElements = document.querySelectorAll('.partner-link, .artist-card');
        
        interactiveElements.forEach(element => {
            // Make elements focusable if they don't have tabindex
            if (!element.hasAttribute('tabindex') && !element.matches('a, button')) {
                element.setAttribute('tabindex', '0');
            }
            
            // Add keyboard event listener
            element.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
        
        // Announce dynamic content changes to screen readers
        const liveRegions = document.querySelectorAll('[aria-live]');
        liveRegions.forEach(region => {
            // Ensure live regions are set up correctly
            if (!region.hasAttribute('aria-atomic')) {
                region.setAttribute('aria-atomic', 'true');
            }
        });
    }
    
    /* ============================================
       INITIALIZATION
       ============================================ */
    
    // Initialize all functions when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        initContactForm();
        initLazyLoading();
        initAccessibility();
        
        console.log('Zomer in Linden theme initialized ✓');
    }
    
})();