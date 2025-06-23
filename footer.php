
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Viziblix</h4>
                <p>Votre agence digitale de confiance pour transformer votre présence en ligne et générer des résultats concrets.</p>
                <div style="margin-top: 1rem;">
                    <a href="https://wa.me/+33123456789" style="margin-right: 1rem;">📱 WhatsApp</a>
                    <a href="mailto:contact@viziblix.com">✉️ Email</a>
                </div>
            </div>
            
            <div class="footer-section">
                <h4>Nos Services</h4>
                <ul style="list-style: none;">
                    <li><a href="#qui-aidons-nous">Création de Sites Web</a></li>
                    <li><a href="#nos-3-phases">Marketing Digital</a></li>
                    <li><a href="#audit-gratuit">Audit Gratuit</a></li>
                    <li><a href="#nos-3-phases">SEO & Référencement</a></li>
                    <li><a href="#nos-3-phases">Réseaux Sociaux</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Liens Utiles</h4>
                <ul style="list-style: none;">
                    <li><a href="#a-propos">À Propos</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="/mentions-legales">Mentions Légales</a></li>
                    <li><a href="/politique-confidentialite">Politique de Confidentialité</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Contactez-Nous</h4>
                <p>📧 contact@viziblix.com</p>
                <p>📱 +33 1 23 45 67 89</p>
                <p>📍 Paris, France</p>
                <div style="margin-top: 1rem;">
                    <a href="#audit-gratuit" class="btn btn-primary">Audit Gratuit</a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Viziblix. Tous droits réservés. | Agence Digitale Spécialisée</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mainNav = document.getElementById('main-nav');
    
    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.textContent = mainNav.classList.contains('active') ? '✕' : '☰';
        });
    }
    
    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const icon = this.querySelector('span');
            
            // Close all other answers
            faqQuestions.forEach(otherQuestion => {
                if (otherQuestion !== this) {
                    const otherAnswer = otherQuestion.nextElementSibling;
                    const otherIcon = otherQuestion.querySelector('span');
                    otherAnswer.classList.remove('active');
                    otherIcon.textContent = '+';
                }
            });
            
            // Toggle current answer
            answer.classList.toggle('active');
            icon.textContent = answer.classList.contains('active') ? '−' : '+';
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80; // Account for fixed header
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                if (mainNav && mainNav.classList.contains('active')) {
                    mainNav.classList.remove('active');
                    mobileMenuToggle.textContent = '☰';
                }
            }
        });
    });
    
    // Form submission handling
    const auditForm = document.getElementById('audit-form');
    if (auditForm) {
        auditForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic form validation
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '#f36f21';
                }
            });
            
            if (isValid) {
                // Show success message
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.textContent;
                button.textContent = 'Envoi en cours...';
                button.disabled = true;
                
                // Simulate form submission
                setTimeout(() => {
                    alert('Merci ! Votre demande d\'audit a été envoyée. Nous vous contactons sous 24h.');
                    this.reset();
                    button.textContent = originalText;
                    button.disabled = false;
                }, 1000);
            } else {
                alert('Veuillez remplir tous les champs obligatoires.');
            }
        });
    }
    
    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Apply animation to cards
    document.querySelectorAll('.card, .pricing-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});
</script>

</body>
</html>
