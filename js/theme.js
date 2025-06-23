
/**
 * Viziblix Theme JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile Menu Functionality
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mainNav = document.getElementById('main-nav');
    
    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.setAttribute('aria-expanded', mainNav.classList.contains('active'));
            this.innerHTML = mainNav.classList.contains('active') ? '✕' : '☰';
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mainNav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                mainNav.classList.remove('active');
                mobileMenuToggle.innerHTML = '☰';
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    // FAQ Accordion Functionality
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach((question, index) => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const icon = this.querySelector('span');
            const isActive = answer.classList.contains('active');
            
            // Close all other answers
            faqQuestions.forEach((otherQuestion, otherIndex) => {
                if (otherIndex !== index) {
                    const otherAnswer = otherQuestion.nextElementSibling;
                    const otherIcon = otherQuestion.querySelector('span');
                    otherAnswer.classList.remove('active');
                    otherIcon.textContent = '+';
                    otherQuestion.setAttribute('aria-expanded', 'false');
                }
            });
            
            // Toggle current answer
            if (isActive) {
                answer.classList.remove('active');
                icon.textContent = '+';
                this.setAttribute('aria-expanded', 'false');
            } else {
                answer.classList.add('active');
                icon.textContent = '−';
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });
    
    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const offsetTop = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                if (mainNav && mainNav.classList.contains('active')) {
                    mainNav.classList.remove('active');
                    mobileMenuToggle.innerHTML = '☰';
                    mobileMenuToggle.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
    
    // Form Validation and Submission
    const auditForm = document.getElementById('audit-form');
    if (auditForm) {
        auditForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Envoi en cours...';
            submitButton.disabled = true;
            
            // Reset button after a delay if form doesn't submit naturally
            setTimeout(() => {
                if (submitButton.disabled) {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                }
            }, 5000);
        });
        
        // Real-time validation
        const formInputs = auditForm.querySelectorAll('input, textarea');
        formInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    }
    
    // Scroll Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                // Only observe once
                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Apply scroll animations to elements
    document.querySelectorAll('.card, .pricing-card, .fade-in-up').forEach(el => {
        el.classList.add('scroll-animate');
        scrollObserver.observe(el);
    });
    
    // Header scroll effect
    let lastScrollTop = 0;
    const header = document.querySelector('.site-header');
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Pricing card hover effects
    const pricingCards = document.querySelectorAll('.pricing-card');
    pricingCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('featured')) {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('featured')) {
                this.style.transform = '';
            }
        });
    });
    
    // Contact method tracking
    document.querySelectorAll('a[href^="https://wa.me"], a[href^="mailto:"], a[href^="tel:"]').forEach(link => {
        link.addEventListener('click', function() {
            const method = this.href.includes('wa.me') ? 'whatsapp' : 
                          this.href.includes('mailto:') ? 'email' : 'phone';
            
            // Track contact method usage (you can integrate with analytics here)
            console.log('Contact method used:', method);
            
            // Optional: Send to analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact_method_click', {
                    'contact_method': method
                });
            }
        });
    });
    
    // Handle success/error messages from form submission
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('audit') === 'success') {
        showNotification('Merci ! Votre demande d\'audit a été envoyée. Nous vous contacterons sous 24h.', 'success');
        // Clean URL
        window.history.replaceState({}, document.title, window.location.pathname);
    } else if (urlParams.get('audit') === 'error') {
        showNotification('Une erreur est survenue. Veuillez réessayer ou nous contacter directement.', 'error');
        // Clean URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});

// Form validation function
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
}

// Individual field validation
function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';
    
    // Remove existing error styling
    field.classList.remove('error');
    const existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Check if required field is empty
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'Ce champ est obligatoire.';
    }
    
    // Type-specific validation
    if (value && field.type === 'email') {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Veuillez entrer une adresse email valide.';
        }
    }
    
    if (value && field.type === 'tel') {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,}$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Veuillez entrer un numéro de téléphone valide.';
        }
    }
    
    if (value && field.type === 'url') {
        try {
            new URL(value);
        } catch {
            isValid = false;
            errorMessage = 'Veuillez entrer une URL valide.';
        }
    }
    
    // Apply error styling if invalid
    if (!isValid) {
        field.classList.add('error');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = errorMessage;
        errorDiv.style.color = '#dc3545';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '0.25rem';
        field.parentNode.appendChild(errorDiv);
    }
    
    return isValid;
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#007bff'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10000;
        max-width: 400px;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 5000);
    
    // Allow manual closing
    notification.addEventListener('click', () => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    });
}

// Add CSS for scroll animations
const style = document.createElement('style');
style.textContent = `
    .scroll-animate {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .scroll-animate.animate-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    .site-header.scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .form-control.error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .notification {
        cursor: pointer;
    }
    
    @media (max-width: 768px) {
        .notification {
            right: 10px;
            left: 10px;
            max-width: none;
        }
    }
`;
document.head.appendChild(style);
