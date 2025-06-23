
<?php
/**
 * Viziblix Elementor Widgets
 * 
 * Custom Elementor widgets for Viziblix theme
 */

if (!defined('ABSPATH')) {
    exit;
}

// Base Widget Class
abstract class Viziblix_Base_Widget extends \Elementor\Widget_Base {
    
    public function get_categories() {
        return ['viziblix-widgets'];
    }
    
    protected function register_style_controls() {
        // Common style controls for all widgets
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'custom_css_class',
            [
                'label' => esc_html__('CSS Class', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('custom-class', 'viziblix-enhanced'),
            ]
        );
        
        $this->end_controls_section();
    }
}

// Hero Widget
class Viziblix_Hero_Widget extends Viziblix_Base_Widget {
    
    public function get_name() {
        return 'viziblix-hero';
    }
    
    public function get_title() {
        return esc_html__('Viziblix Hero', 'viziblix-enhanced');
    }
    
    public function get_icon() {
        return 'eicon-banner';
    }
    
    protected function register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Transformez Votre Présence Digitale', 'viziblix-enhanced'),
                'placeholder' => esc_html__('Type your title here', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Avec Viziblix Enhanced, Votre Agence Digitale de Confiance', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => esc_html__('Nous aidons les entreprises à prospérer dans le monde numérique grâce à des stratégies sur mesure, des sites web performants et un marketing digital qui génère des résultats concrets.', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'primary_button_text',
            [
                'label' => esc_html__('Primary Button Text', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Obtenez Votre Audit Gratuit', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'primary_button_link',
            [
                'label' => esc_html__('Primary Button Link', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'viziblix-enhanced'),
                'default' => [
                    'url' => '#audit-gratuit',
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_text',
            [
                'label' => esc_html__('Secondary Button Text', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Découvrir Nos Services', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'secondary_button_link',
            [
                'label' => esc_html__('Secondary Button Link', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'viziblix-enhanced'),
                'default' => [
                    'url' => '#qui-aidons-nous',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->register_style_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $primary_target = $settings['primary_button_link']['is_external'] ? ' target="_blank"' : '';
        $primary_nofollow = $settings['primary_button_link']['nofollow'] ? ' rel="nofollow"' : '';
        
        $secondary_target = $settings['secondary_button_link']['is_external'] ? ' target="_blank"' : '';
        $secondary_nofollow = $settings['secondary_button_link']['nofollow'] ? ' rel="nofollow"' : '';
        
        ?>
        <section class="hero elementor-hero <?php echo esc_attr($settings['custom_css_class']); ?>">
            <div class="container">
                <h1><?php echo esc_html($settings['title']); ?></h1>
                <p class="subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                <p><?php echo esc_html($settings['description']); ?></p>
                <div style="margin-top: 2rem;">
                    <a href="<?php echo esc_url($settings['primary_button_link']['url']); ?>" class="btn btn-primary"<?php echo $primary_target . $primary_nofollow; ?>>
                        <?php echo esc_html($settings['primary_button_text']); ?>
                    </a>
                    <a href="<?php echo esc_url($settings['secondary_button_link']['url']); ?>" class="btn btn-secondary"<?php echo $secondary_target . $secondary_nofollow; ?>>
                        <?php echo esc_html($settings['secondary_button_text']); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php
    }
}

// Services Widget
class Viziblix_Services_Widget extends Viziblix_Base_Widget {
    
    public function get_name() {
        return 'viziblix-services';
    }
    
    public function get_title() {
        return esc_html__('Viziblix Services', 'viziblix-enhanced');
    }
    
    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    protected function register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Qui Aidons-Nous ?', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Section Description', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nous accompagnons différents types d\'entreprises dans leur transformation digitale', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'services_list',
            [
                'label' => esc_html__('Services', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'service_icon',
                        'label' => esc_html__('Icon', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '🏢',
                    ],
                    [
                        'name' => 'service_title',
                        'label' => esc_html__('Title', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Service Title', 'viziblix-enhanced'),
                    ],
                    [
                        'name' => 'service_description',
                        'label' => esc_html__('Description', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Service description here', 'viziblix-enhanced'),
                    ],
                ],
                'default' => [
                    [
                        'service_icon' => '🏢',
                        'service_title' => 'PME & Startups',
                        'service_description' => 'Développement de votre présence en ligne avec des solutions adaptées à votre budget et vos objectifs de croissance.',
                    ],
                    [
                        'service_icon' => '🛍️',
                        'service_title' => 'E-commerce',
                        'service_description' => 'Création et optimisation de boutiques en ligne performantes pour maximiser vos ventes et fidéliser vos clients.',
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );
        
        $this->end_controls_section();
        
        $this->register_style_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>
        <section class="section elementor-services <?php echo esc_attr($settings['custom_css_class']); ?>">
            <div class="container">
                <h2 class="text-center text-orange"><?php echo esc_html($settings['section_title']); ?></h2>
                <p class="text-center mb-4"><?php echo esc_html($settings['section_description']); ?></p>
                
                <div class="cards-grid">
                    <?php foreach ($settings['services_list'] as $index => $service) : ?>
                    <article class="card fade-in-up">
                        <div class="card-icon" aria-hidden="true"><?php echo esc_html($service['service_icon']); ?></div>
                        <h3><?php echo esc_html($service['service_title']); ?></h3>
                        <p><?php echo esc_html($service['service_description']); ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

// Pricing Widget
class Viziblix_Pricing_Widget extends Viziblix_Base_Widget {
    
    public function get_name() {
        return 'viziblix-pricing';
    }
    
    public function get_title() {
        return esc_html__('Viziblix Pricing', 'viziblix-enhanced');
    }
    
    public function get_icon() {
        return 'eicon-price-table';
    }
    
    protected function register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Nos 3 Phases pour Votre Succès', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'pricing_plans',
            [
                'label' => esc_html__('Pricing Plans', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'plan_title',
                        'label' => esc_html__('Plan Title', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Phase 1: Fondations', 'viziblix-enhanced'),
                    ],
                    [
                        'name' => 'plan_price',
                        'label' => esc_html__('Price', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '1 500€',
                    ],
                    [
                        'name' => 'plan_period',
                        'label' => esc_html__('Period', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '/ mois',
                    ],
                    [
                        'name' => 'plan_features',
                        'label' => esc_html__('Features', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Feature 1\nFeature 2\nFeature 3',
                    ],
                    [
                        'name' => 'button_text',
                        'label' => esc_html__('Button Text', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Commencer',
                    ],
                    [
                        'name' => 'button_link',
                        'label' => esc_html__('Button Link', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'default' => ['url' => '#audit-gratuit'],
                    ],
                    [
                        'name' => 'is_featured',
                        'label' => esc_html__('Featured Plan', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'default' => '',
                    ],
                ],
                'title_field' => '{{{ plan_title }}}',
            ]
        );
        
        $this->end_controls_section();
        
        $this->register_style_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>
        <section class="section bg-light elementor-pricing <?php echo esc_attr($settings['custom_css_class']); ?>">
            <div class="container">
                <h2 class="text-center text-orange"><?php echo esc_html($settings['section_title']); ?></h2>
                
                <div class="pricing-grid">
                    <?php foreach ($settings['pricing_plans'] as $plan) : 
                        $target = $plan['button_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $plan['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                        $featured_class = $plan['is_featured'] ? ' featured' : '';
                    ?>
                    <article class="pricing-card<?php echo $featured_class; ?>">
                        <h3><?php echo esc_html($plan['plan_title']); ?></h3>
                        <div class="price">
                            <?php echo esc_html($plan['plan_price']); ?>
                            <span class="price-period"><?php echo esc_html($plan['plan_period']); ?></span>
                        </div>
                        <ul style="text-align: left; margin: 2rem 0; list-style: none;">
                            <?php 
                            $features = explode("\n", $plan['plan_features']);
                            foreach ($features as $feature) : 
                                if (!empty(trim($feature))) :
                            ?>
                            <li>✅ <?php echo esc_html(trim($feature)); ?></li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                        <a href="<?php echo esc_url($plan['button_link']['url']); ?>" class="btn <?php echo $plan['is_featured'] ? 'btn-primary' : 'btn-secondary'; ?>"<?php echo $target . $nofollow; ?>>
                            <?php echo esc_html($plan['button_text']); ?>
                        </a>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

// FAQ Widget
class Viziblix_FAQ_Widget extends Viziblix_Base_Widget {
    
    public function get_name() {
        return 'viziblix-faq';
    }
    
    public function get_title() {
        return esc_html__('Viziblix FAQ', 'viziblix-enhanced');
    }
    
    public function get_icon() {
        return 'eicon-accordion';
    }
    
    protected function register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Questions Fréquentes', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'faq_items',
            [
                'label' => esc_html__('FAQ Items', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'question',
                        'label' => esc_html__('Question', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Your question here?', 'viziblix-enhanced'),
                    ],
                    [
                        'name' => 'answer',
                        'label' => esc_html__('Answer', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Your answer here.', 'viziblix-enhanced'),
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );
        
        $this->end_controls_section();
        
        $this->register_style_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>
        <section class="section bg-light elementor-faq <?php echo esc_attr($settings['custom_css_class']); ?>">
            <div class="container">
                <h2 class="text-center text-orange"><?php echo esc_html($settings['section_title']); ?></h2>
                <div style="max-width: 800px; margin: 3rem auto 0;">
                    <?php foreach ($settings['faq_items'] as $index => $item) : ?>
                    <article class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <?php echo esc_html($item['question']); ?>
                            <span aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p><?php echo esc_html($item['answer']); ?></p>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

// Contact Widget
class Viziblix_Contact_Widget extends Viziblix_Base_Widget {
    
    public function get_name() {
        return 'viziblix-contact';
    }
    
    public function get_title() {
        return esc_html__('Viziblix Contact Form', 'viziblix-enhanced');
    }
    
    public function get_icon() {
        return 'eicon-form-horizontal';
    }
    
    protected function register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Obtenez Votre Audit Gratuit', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Section Description', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Découvrez les opportunités d\'amélioration de votre présence digitale', 'viziblix-enhanced'),
            ]
        );
        
        $this->end_controls_section();
        
        $this->register_style_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>
        <section class="section form-section elementor-contact <?php echo esc_attr($settings['custom_css_class']); ?>">
            <div class="container">
                <h2 class="text-center text-orange"><?php echo esc_html($settings['section_title']); ?></h2>
                <p class="text-center mb-4"><?php echo esc_html($settings['section_description']); ?></p>
                
                <div class="form-container">
                    <form id="audit-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" novalidate>
                        <input type="hidden" name="action" value="submit_audit_form">
                        <?php wp_nonce_field('audit_form_nonce', 'audit_nonce'); ?>
                        
                        <div class="form-group">
                            <label for="full_name">Nom Complet *</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" required aria-describedby="full_name-help">
                            <div id="full_name-help" class="sr-only">Votre nom et prénom complets</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="company">Nom de l'Entreprise *</label>
                            <input type="text" id="company" name="company" class="form-control" required aria-describedby="company-help">
                            <div id="company-help" class="sr-only">Le nom de votre entreprise ou organisation</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="whatsapp">Numéro WhatsApp *</label>
                            <input type="tel" id="whatsapp" name="whatsapp" class="form-control" required aria-describedby="whatsapp-help">
                            <div id="whatsapp-help" class="sr-only">Votre numéro WhatsApp avec l'indicatif pays</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="website">Site Web Actuel</label>
                            <input type="url" id="website" name="website" class="form-control" placeholder="https://votre-site.com" aria-describedby="website-help">
                            <div id="website-help" class="sr-only">L'adresse complète de votre site web actuel si vous en avez un</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Décrivez vos objectifs digitaux</label>
                            <textarea id="message" name="message" class="form-control" rows="4" aria-describedby="message-help"></textarea>
                            <div id="message-help" class="sr-only">Décrivez vos objectifs, défis ou questions concernant votre présence digitale</div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Recevoir Mon Audit Gratuit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php
    }
}

// Testimonials Widget
class Viziblix_Testimonials_Widget extends Viziblix_Base_Widget {
    
    public function get_name() {
        return 'viziblix-testimonials';
    }
    
    public function get_title() {
        return esc_html__('Viziblix Testimonials', 'viziblix-enhanced');
    }
    
    public function get_icon() {
        return 'eicon-testimonial';
    }
    
    protected function register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'viziblix-enhanced'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Ce Que Disent Nos Clients', 'viziblix-enhanced'),
            ]
        );
        
        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'viziblix-enhanced'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'testimonial_content',
                        'label' => esc_html__('Testimonial Content', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Great service and professional team!', 'viziblix-enhanced'),
                    ],
                    [
                        'name' => 'client_name',
                        'label' => esc_html__('Client Name', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('John Doe', 'viziblix-enhanced'),
                    ],
                    [
                        'name' => 'client_position',
                        'label' => esc_html__('Client Position/Company', 'viziblix-enhanced'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('CEO, Company Name', 'viziblix-enhanced'),
                    ],
                ],
                'title_field' => '{{{ client_name }}}',
            ]
        );
        
        $this->end_controls_section();
        
        $this->register_style_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>
        <section class="section elementor-testimonials <?php echo esc_attr($settings['custom_css_class']); ?>">
            <div class="container">
                <h2 class="text-center text-orange"><?php echo esc_html($settings['section_title']); ?></h2>
                
                <div class="testimonials-slider" role="region" aria-label="Témoignages clients" tabindex="0">
                    <div class="testimonials-track">
                        <?php foreach ($settings['testimonials'] as $index => $testimonial) : ?>
                        <article class="testimonial-slide" aria-hidden="<?php echo $index === 0 ? 'false' : 'true'; ?>">
                            <div class="testimonial-content">
                                "<?php echo esc_html($testimonial['testimonial_content']); ?>"
                            </div>
                            <div class="testimonial-author"><?php echo esc_html($testimonial['client_name']); ?></div>
                            <div class="testimonial-company"><?php echo esc_html($testimonial['client_position']); ?></div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="slider-nav" role="tablist" aria-label="Navigation témoignages">
                        <?php foreach ($settings['testimonials'] as $index => $testimonial) : ?>
                        <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" role="tab" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="Témoignage <?php echo $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
