
/**
 * Viziblix Enhanced Theme JavaScript
 * Includes mobile menu, FAQ accordion, sticky header, testimonials slider, and accessibility features
 */

(function() {
    'use strict';
    
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeMobileMenu();
        initializeFAQAccordion();
        initializeStickyHeader();
        initializeTestimonialsSlider();
        initializeBackToTop();
        initializeSmoothScrolling();
        initializeFormValidation();
        initializeScrollAnimations();
        initializeAccessibility();
        handleFormSubmissionFeedback();
    });

    // Mobile Menu Functionality
    function initializeMobileMenu() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mainNav = document.getElementById('main-nav');
        
        if (!mobileMenuToggle || !mainNav) return;
        
        mobileMenuToggle.addEventListener('click', function() {
            const isOpen = mainNav.classList.contains('active');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mainNav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                closeMobileMenu();
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mainNav.classList.contains('active')) {
                closeMobileMenu();
                mobileMenuToggle.focus();
            }
        });
        
        function openMobileMenu() {
            mainNav.classList.add('active');
            mobileMenuToggle.innerHTML = '<span aria-hidden="true">✕</span>';
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            mobileMenuToggle.setAttribute('aria-label', 'Fermer le menu de navigation');
            
            // Focus management
            const firstLink = mainNav.querySelector('a');
            if (firstLink) {
                firstLink.focus();
            }
        }
        
        function closeMobileMenu() {
            mainNav.classList.remove('active');
            mobileMenuToggle.innerHTML = '<span aria-hidden="true">☰</span>';
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            mobileMenuToggle.setAttribute('aria-label', 'Ouvrir le menu de navigation');
        }
        
        // Close menu when clicking on menu links
        const menuLinks = mainNav.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }

    // FAQ Accordion Functionality
    function initializeFAQAccordion() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach((question, index) => {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('span');
            
            // Set initial ARIA attributes
            question.setAttribute('aria-expanded', 'false');
            question.setAttribute('id', `faq-question-${index}`);
            if (answer) {
                answer.setAttribute('id', `faq-answer-${index}`);
                question.setAttribute('aria-controls', `faq-answer-${index}`);
            }
            
            question.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                // Close all other FAQs
                faqQuestions.forEach((otherQuestion, otherIndex) => {
                    if (otherIndex !== index) {
                        const otherAnswer = otherQuestion.nextElementSibling;
                        const otherIcon = otherQuestion.querySelector('span');
                        
                        otherAnswer.classList.remove('active');
                        otherQuestion.setAttribute('aria-expanded', 'false');
                        if (otherIcon) otherIcon.textContent = '+';
                    }
                });
                
                // Toggle current FAQ
                if (isExpanded) {
                    answer.classList.remove('active');
                    this.setAttribute('aria-expanded', 'false');
                    if (icon) icon.textContent = '+';
                } else {
                    answer.classList.add('active');
                    this.setAttribute('aria-expanded', 'true');
                    if (icon) icon.textContent = '−';
                }
            });
            
            // Keyboard navigation
            question.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
    }

    // Sticky Header Functionality
    function initializeStickyHeader() {
        const header = document.querySelector('.site-header');
        if (!header) return;
        
        let lastScrollTop = 0;
        let ticking = false;
        
        function updateHeader() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop;
            ticking = false;
        }
        
        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestTick, { passive: true });
    }

    // Testimonials Slider
    function initializeTestimonialsSlider() {
        const slider = document.querySelector('.testimonials-slider');
        if (!slider) return;
        
        const track = slider.querySelector('.testimonials-track');
        const slides = slider.querySelectorAll('.testimonial-slide');
        const dots = slider.querySelectorAll('.slider-dot');
        
        if (!track || slides.length === 0) return;
        
        let currentSlide = 0;
        let isAutoPlaying = true;
        let autoPlayInterval;
        
        function goToSlide(index) {
            currentSlide = index;
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update dots
            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('active', dotIndex === currentSlide);
                dot.setAttribute('aria-pressed', dotIndex === currentSlide);
            });
            
            // Update aria-label for accessibility
            slides.forEach((slide, slideIndex) => {
                slide.setAttribute('aria-hidden', slideIndex !== currentSlide);
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            goToSlide(currentSlide);
        }
        
        function startAutoPlay() {
            if (isAutoPlaying) {
                autoPlayInterval = setInterval(nextSlide, 5000);
            }
        }
        
        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }
        
        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
                stopAutoPlay();
                isAutoPlaying = false;
            });
            
            dot.setAttribute('role', 'button');
            dot.setAttribute('aria-pressed', 'false');
        });
        
        // Keyboard navigation
        slider.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                currentSlide = currentSlide > 0 ? currentSlide - 1 : slides.length - 1;
                goToSlide(currentSlide);
                stopAutoPlay();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextSlide();
                stopAutoPlay();
            }
        });
        
        // Pause on hover/focus
        slider.addEventListener('mouseenter', stopAutoPlay);
        slider.addEventListener('mouseleave', startAutoPlay);
        slider.addEventListener('focusin', stopAutoPlay);
        slider.addEventListener('focusout', startAutoPlay);
        
        // Initialize
        goToSlide(0);
        startAutoPlay();
    }

    // Back to Top Button
    function initializeBackToTop() {
        const backToTopButton = document.querySelector('.back-to-top');
        if (!backToTopButton) return;
        
        let ticking = false;
        
        function updateButtonVisibility() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
            
            ticking = false;
        }
        
        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateButtonVisibility);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestTick, { passive: true });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Smooth Scrolling for Anchor Links
    function initializeSmoothScrolling() {
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
                    const mainNav = document.getElementById('main-nav');
                    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
                    if (mainNav && mainNav.classList.contains('active')) {
                        mainNav.classList.remove('active');
                        mobileMenuToggle.innerHTML = '<span aria-hidden="true">☰</span>';
                        mobileMenuToggle.setAttribute('aria-expanded', 'false');
                    }
                    
                    // Focus management for accessibility
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        });
    }

    // Form Validation and Submission
    function initializeFormValidation() {
        const auditForm = document.getElementById('audit-form');
        if (!auditForm) return;
        
        auditForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                const originalText = submitButton.textContent;
                submitButton.textContent = 'Envoi en cours...';
                submitButton.disabled = true;
                submitButton.classList.add('loading');
                
                // Reset button after timeout if form doesn't submit naturally
                setTimeout(() => {
                    if (submitButton.disabled) {
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                        submitButton.classList.remove('loading');
                    }
                }, 10000);
            }
        });
        
        // Real-time validation
        const formInputs = auditForm.querySelectorAll('input, textarea');
        formInputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('input', () => {
                if (input.classList.contains('error')) {
                    validateField(input);
                }
            });
        });
    }

    // Form Validation Functions
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
            field.setAttribute('aria-invalid', 'true');
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = errorMessage;
            errorDiv.id = field.id + '-error';
            errorDiv.setAttribute('role', 'alert');
            field.setAttribute('aria-describedby', errorDiv.id);
            field.parentNode.appendChild(errorDiv);
        } else {
            field.setAttribute('aria-invalid', 'false');
            field.removeAttribute('aria-describedby');
        }
        
        return isValid;
    }

    // Scroll Animations
    function initializeScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    scrollObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Apply scroll animations to elements
        document.querySelectorAll('.card, .pricing-card, .fade-in-up').forEach(el => {
            el.classList.add('scroll-animate');
            scrollObserver.observe(el);
        });
    }

    // Accessibility Enhancements
    function initializeAccessibility() {
        // Focus management for skip links
        const skipLink = document.querySelector('.screen-reader-text');
        if (skipLink) {
            skipLink.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.focus();
                }
            });
        }
        
        // Improved keyboard navigation for cards
        document.querySelectorAll('.card, .pricing-card').forEach(card => {
            card.setAttribute('tabindex', '0');
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    const link = this.querySelector('a, button');
                    if (link) {
                        e.preventDefault();
                        link.click();
                    }
                }
            });
        });
        
        // Announce dynamic content changes
        const announcer = document.createElement('div');
        announcer.setAttribute('aria-live', 'polite');
        announcer.setAttribute('aria-atomic', 'true');
        announcer.className = 'sr-only';
        announcer.id = 'aria-announcer';
        document.body.appendChild(announcer);
        
        window.announceToScreenReader = function(message) {
            announcer.textContent = message;
            setTimeout(() => {
                announcer.textContent = '';
            }, 1000);
        };
    }

    // Handle Form Submission Feedback
    function handleFormSubmissionFeedback() {
        const urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.get('audit') === 'success') {
            showNotification('Merci ! Votre demande d\'audit a été envoyée. Nous vous contacterons sous 24h.', 'success');
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if (urlParams.get('audit') === 'error') {
            showNotification('Une erreur est survenue. Veuillez réessayer ou nous contacter directement.', 'error');
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    // Notification System
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.setAttribute('role', 'alert');
        notification.setAttribute('aria-live', 'assertive');
        
        const colors = {
            success: '#28a745',
            error: '#dc3545',
            info: '#007bff'
        };
        
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: ${colors[type] || colors.info};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            max-width: 400px;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            cursor: pointer;
        `;
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto remove after 5 seconds
        const removeNotification = () => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        };
        
        setTimeout(removeNotification, 5000);
        notification.addEventListener('click', removeNotification);
        
        // Announce to screen readers
        if (window.announceToScreenReader) {
            window.announceToScreenReader(message);
        }
    }

    // Contact method tracking for analytics
    document.querySelectorAll('a[href^="https://wa.me"], a[href^="mailto:"], a[href^="tel:"]').forEach(link => {
        link.addEventListener('click', function() {
            const method = this.href.includes('wa.me') ? 'whatsapp' : 
                          this.href.includes('mailto:') ? 'email' : 'phone';
            
            console.log('Contact method used:', method);
            
            // Send to analytics if available
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact_method_click', {
                    'contact_method': method
                });
            }
        });
    });

    // Fallback for browsers without JavaScript
    const noJsElements = document.querySelectorAll('.no-js-hidden');
    noJsElements.forEach(el => el.style.display = 'block');

})();
