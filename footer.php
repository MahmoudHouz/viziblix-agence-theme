
<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Viziblix Enhanced</h4>
                <p>Votre agence digitale de confiance pour transformer votre présence en ligne et générer des résultats concrets avec les dernières technologies.</p>
                <div style="margin-top: 1rem;">
                    <a href="https://wa.me/<?php echo esc_attr(str_replace(array(' ', '-', '(', ')'), '', get_theme_mod('whatsapp_number', '+33123456789'))); ?>" 
                       style="margin-right: 1rem; color: inherit; text-decoration: none;" 
                       target="_blank" 
                       rel="noopener"
                       aria-label="Nous contacter sur WhatsApp">
                        <span aria-hidden="true">📱</span> WhatsApp
                    </a>
                    <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'contact@viziblix.com')); ?>" 
                       style="color: inherit; text-decoration: none;"
                       aria-label="Nous envoyer un email">
                        <span aria-hidden="true">✉️</span> Email
                    </a>
                </div>
            </div>
            
            <div class="footer-section">
                <h4>Nos Services</h4>
                <nav aria-label="Menu des services">
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <li><a href="#qui-aidons-nous">Création de Sites Web</a></li>
                        <li><a href="#nos-3-phases">Marketing Digital</a></li>
                        <li><a href="#audit-gratuit">Audit Gratuit</a></li>
                        <li><a href="#nos-3-phases">SEO & Référencement</a></li>
                        <li><a href="#nos-3-phases">Réseaux Sociaux</a></li>
                        <li><a href="#temoignages">Témoignages Clients</a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="footer-section">
                <h4>Liens Utiles</h4>
                <nav aria-label="Menu des liens utiles">
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <li><a href="#a-propos">À Propos</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="<?php echo esc_url(home_url('/mentions-legales')); ?>">Mentions Légales</a></li>
                        <li><a href="<?php echo esc_url(home_url('/politique-confidentialite')); ?>">Politique de Confidentialité</a></li>
                        <li><a href="<?php echo esc_url(home_url('/plan-du-site')); ?>">Plan du Site</a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="footer-section">
                <h4>Contactez-Nous</h4>
                <address style="font-style: normal;">
                    <p>
                        <span aria-hidden="true">📧</span> 
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'contact@viziblix.com')); ?>">
                            <?php echo esc_html(get_theme_mod('contact_email', 'contact@viziblix.com')); ?>
                        </a>
                    </p>
                    <p>
                        <span aria-hidden="true">📱</span> 
                        <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-', '(', ')'), '', get_theme_mod('whatsapp_number', '+33123456789'))); ?>">
                            <?php echo esc_html(get_theme_mod('whatsapp_number', '+33 1 23 45 67 89')); ?>
                        </a>
                    </p>
                    <p><span aria-hidden="true">📍</span> Paris, France</p>
                </address>
                <div style="margin-top: 1rem;">
                    <a href="#audit-gratuit" class="btn btn-primary">Audit Gratuit</a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Viziblix Enhanced. <?php _e('Tous droits réservés.', 'viziblix-enhanced'); ?> | <?php _e('Agence Digitale Spécialisée', 'viziblix-enhanced'); ?></p>
            <p style="margin-top: 0.5rem; font-size: 0.9rem; opacity: 0.8;">
                <?php _e('Thème WordPress professionnel avec accessibilité et performance optimisées', 'viziblix-enhanced'); ?>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<!-- No-JS fallback styles -->
<noscript>
    <style>
        .faq-answer { max-height: none !important; display: block !important; }
        .testimonials-slider { overflow: visible; }
        .testimonials-track { display: block; }
        .testimonial-slide { min-width: auto; margin-bottom: 2rem; }
        .slider-nav { display: none; }
        .mobile-menu-toggle { display: none; }
        .main-nav { display: block !important; }
        .back-to-top { display: none !important; }
    </style>
</noscript>

<!-- Enhanced performance and accessibility scripts -->
<script>
// Immediate font loading optimization
if ('fonts' in document) {
    document.fonts.load('400 16px Inter').then(() => {
        document.body.classList.add('fonts-loaded');
    });
}

// Immediate critical performance improvements
(function() {
    // Reduce layout shifts
    if (window.requestIdleCallback) {
        requestIdleCallback(function() {
            // Lazy load non-critical images
            const images = document.querySelectorAll('img[data-src]');
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                images.forEach(img => imageObserver.observe(img));
            }
        });
    }
    
    // Preload critical resources
    const link = document.createElement('link');
    link.rel = 'preload';
    link.href = '<?php echo get_template_directory_uri(); ?>/js/theme.js';
    link.as = 'script';
    document.head.appendChild(link);
})();

// Enhanced error handling
window.addEventListener('error', function(e) {
    console.warn('Viziblix Enhanced: JavaScript error caught:', e.error);
    // Could send to analytics or error tracking service
});

// Performance monitoring
if ('performance' in window && 'measure' in window.performance) {
    window.addEventListener('load', function() {
        setTimeout(function() {
            const perfData = performance.getEntriesByType('navigation')[0];
            console.log('Viziblix Enhanced Performance:', {
                domContentLoaded: perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart,
                load: perfData.loadEventEnd - perfData.loadEventStart,
                firstPaint: performance.getEntriesByType('paint')[0]?.startTime || 'N/A'
            });
        }, 0);
    });
}
</script>

</body>
</html>
