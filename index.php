<?php get_header(); ?>

<?php if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID())) : ?>
    <!-- Page built with Elementor -->
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
<?php else : ?>
    <!-- Default static content (fallback) -->
    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <div class="container">
            <h1>Transformez Votre Présence Digitale</h1>
            <p class="subtitle">Avec Viziblix Enhanced, Votre Agence Digitale de Confiance</p>
            <p>Nous aidons les entreprises à prospérer dans le monde numérique grâce à des stratégies sur mesure, des sites web performants et un marketing digital qui génère des résultats concrets.</p>
            <div style="margin-top: 2rem;">
                <a href="#audit-gratuit" class="btn btn-primary">Obtenez Votre Audit Gratuit</a>
                <a href="#qui-aidons-nous" class="btn btn-secondary">Découvrir Nos Services</a>
            </div>
        </div>
    </section>

    <!-- Qui Aidons-Nous Section -->
    <section class="section" id="qui-aidons-nous">
        <div class="container">
            <h2 class="text-center text-orange">Qui Aidons-Nous ?</h2>
            <p class="text-center mb-4">Nous accompagnons différents types d'entreprises dans leur transformation digitale</p>
            
            <div class="cards-grid">
                <article class="card fade-in-up">
                    <div class="card-icon" aria-hidden="true">🏢</div>
                    <h3>PME & Startups</h3>
                    <p>Développement de votre présence en ligne avec des solutions adaptées à votre budget et vos objectifs de croissance.</p>
                </article>
                
                <article class="card fade-in-up">
                    <div class="card-icon" aria-hidden="true">🛍️</div>
                    <h3>E-commerce</h3>
                    <p>Création et optimisation de boutiques en ligne performantes pour maximiser vos ventes et fidéliser vos clients.</p>
                </article>
                
                <article class="card fade-in-up">
                    <div class="card-icon" aria-hidden="true">⚕️</div>
                    <h3>Professionnels de Santé</h3>
                    <p>Sites web conformes et stratégies digitales respectueuses de la déontologie médicale.</p>
                </article>
                
                <article class="card fade-in-up">
                    <div class="card-icon" aria-hidden="true">🎯</div>
                    <h3>Consultants & Coachs</h3>
                    <p>Positionnement d'expert et génération de leads qualifiés grâce à une stratégie de contenu efficace.</p>
                </article>
                
                <article class="card fade-in-up">
                    <div class="card-icon" aria-hidden="true">🏠</div>
                    <h3>Secteur Immobilier</h3>
                    <p>Outils digitaux pour présenter vos biens et capturer des prospects qualifiés.</p>
                </article>
                
                <article class="card fade-in-up">
                    <div class="card-icon" aria-hidden="true">🎨</div>
                    <h3>Artisans & Créateurs</h3>
                    <p>Mise en valeur de votre savoir-faire et de vos créations sur des plateformes adaptées.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Nos 3 Phases Section -->
    <section class="section bg-light" id="nos-3-phases">
        <div class="container">
            <h2 class="text-center text-orange">Nos 3 Phases pour Votre Succès</h2>
            <p class="text-center mb-4">Une approche structurée pour des résultats garantis</p>
            
            <div class="pricing-grid">
                <article class="pricing-card">
                    <h3>Phase 1: Fondations</h3>
                    <div class="price">
                        1 500€
                        <span class="price-period">/ mois</span>
                    </div>
                    <ul style="text-align: left; margin: 2rem 0; list-style: none;">
                        <li>✅ Audit complet de votre présence digitale</li>
                        <li>✅ Création/refonte de site web responsive</li>
                        <li>✅ Optimisation SEO de base</li>
                        <li>✅ Configuration Google Analytics & Search Console</li>
                        <li>✅ Stratégie de contenu personnalisée</li>
                        <li>✅ Formation aux outils digitaux</li>
                    </ul>
                    <a href="#audit-gratuit" class="btn btn-secondary">Commencer</a>
                </article>
                
                <article class="pricing-card featured">
                    <h3>Phase 2: Croissance</h3>
                    <div class="price">
                        2 500€
                        <span class="price-period">/ mois</span>
                    </div>
                    <ul style="text-align: left; margin: 2rem 0; list-style: none;">
                        <li>✅ Tout de la Phase 1</li>
                        <li>✅ Campagnes publicitaires Google Ads</li>
                        <li>✅ Gestion réseaux sociaux (2 plateformes)</li>
                        <li>✅ Email marketing automation</li>
                        <li>✅ Création de contenu (blog, vidéos)</li>
                        <li>✅ Lead nurturing avancé</li>
                        <li>✅ Reporting mensuel détaillé</li>
                    </ul>
                    <a href="#audit-gratuit" class="btn btn-primary">Offre Populaire</a>
                </article>
                
                <article class="pricing-card">
                    <h3>Phase 3: Optimisation</h3>
                    <div class="price">
                        3 500€
                        <span class="price-period">/ mois</span>
                    </div>
                    <ul style="text-align: left; margin: 2rem 0; list-style: none;">
                        <li>✅ Tout des Phases 1 & 2</li>
                        <li>✅ Intelligence artificielle et automation</li>
                        <li>✅ Analyse prédictive des performances</li>
                        <li>✅ Optimisation continue basée sur les données</li>
                        <li>✅ Support prioritaire 24/7</li>
                        <li>✅ Stratégies de rétention client</li>
                        <li>✅ Accompagnement stratégique mensuel</li>
                    </ul>
                    <a href="#audit-gratuit" class="btn btn-secondary">Contactez-nous</a>
                </article>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section" id="temoignages">
        <div class="container">
            <h2 class="text-center text-orange">Ce Que Disent Nos Clients</h2>
            <p class="text-center mb-4">Des résultats concrets qui parlent d'eux-mêmes</p>
            
            <div class="testimonials-slider" role="region" aria-label="Témoignages clients" tabindex="0">
                <div class="testimonials-track">
                    <article class="testimonial-slide" aria-hidden="false">
                        <div class="testimonial-content">
                            "Viziblix a transformé notre présence en ligne. En 6 mois, notre chiffre d'affaires a augmenté de 180% grâce à leur stratégie digitale sur mesure."
                        </div>
                        <div class="testimonial-author">Marie Dubois</div>
                        <div class="testimonial-company">Directrice, Boutique Élégance</div>
                    </article>
                    
                    <article class="testimonial-slide" aria-hidden="true">
                        <div class="testimonial-content">
                            "L'équipe de Viziblix comprend vraiment les enjeux du secteur médical. Notre nouveau site respecte parfaitement la déontologie tout en étant moderne."
                        </div>
                        <div class="testimonial-author">Dr. Laurent Martin</div>
                        <div class="testimonial-company">Chirurgien-dentiste</div>
                    </article>
                    
                    <article class="testimonial-slide" aria-hidden="true">
                        <div class="testimonial-content">
                            "Professionnalisme, réactivité et résultats au rendez-vous. Viziblix nous a aidés à tripler nos demandes de devis en ligne en moins d'un an."
                        </div>
                        <div class="testimonial-author">Jean-Pierre Leclerc</div>
                        <div class="testimonial-company">Fondateur, Artisan Plus</div>
                    </article>
                    
                    <article class="testimonial-slide" aria-hidden="true">
                        <div class="testimonial-content">
                            "Une approche data-driven qui fait la différence. Nos campagnes publicitaires sont désormais 3x plus efficaces qu'avant."
                        </div>
                        <div class="testimonial-author">Sarah Cohen</div>
                        <div class="testimonial-company">Responsable Marketing, TechStart</div>
                    </article>
                </div>
                
                <div class="slider-nav" role="tablist" aria-label="Navigation témoignages">
                    <button class="slider-dot active" role="tab" aria-selected="true" aria-label="Témoignage 1"></button>
                    <button class="slider-dot" role="tab" aria-selected="false" aria-label="Témoignage 2"></button>
                    <button class="slider-dot" role="tab" aria-selected="false" aria-label="Témoignage 3"></button>
                    <button class="slider-dot" role="tab" aria-selected="false" aria-label="Témoignage 4"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Audit Gratuit Form -->
    <section class="section form-section" id="audit-gratuit">
        <div class="container">
            <h2 class="text-center text-orange">Obtenez Votre Audit Gratuit</h2>
            <p class="text-center mb-4">Découvrez les opportunités d'amélioration de votre présence digitale</p>
            
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
                
                <noscript>
                    <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 1rem; margin-top: 1rem; border-radius: 5px;">
                        <p><strong>JavaScript est désactivé.</strong> Le formulaire fonctionnera toujours, mais certaines fonctionnalités de validation ne seront pas disponibles. Assurez-vous de remplir tous les champs obligatoires.</p>
                    </div>
                </noscript>
            </div>
        </div>
    </section>

    <!-- À Propos Section -->
    <section class="section" id="a-propos">
        <div class="container">
            <h2 class="text-center text-orange">À Propos de Viziblix Enhanced</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-top: 3rem;" class="about-grid">
                <div>
                    <h3>Notre Mission</h3>
                    <p>Chez Viziblix Enhanced, nous croyons que chaque entreprise mérite une présence digitale qui reflète sa valeur et attire ses clients idéaux. Notre équipe d'experts combine créativité, technologie et stratégie pour transformer votre vision en succès mesurable.</p>
                    
                    <h3>Pourquoi Nous Choisir ?</h3>
                    <ul style="margin: 1rem 0; list-style: none;">
                        <li>✅ +150 projets réussis</li>
                        <li>✅ ROI moyen de 300% pour nos clients</li>
                        <li>✅ Support réactif et personnalisé</li>
                        <li>✅ Transparence totale sur nos méthodes</li>
                        <li>✅ Garantie de résultats</li>
                        <li>✅ Expertise technique avancée</li>
                    </ul>
                </div>
                <div style="text-align: center;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/team-placeholder.jpg" alt="Équipe Viziblix Enhanced travaillant sur des projets digitaux" style="max-width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section bg-light" id="faq">
        <div class="container">
            <h2 class="text-center text-orange">Questions Fréquentes</h2>
            <div style="max-width: 800px; margin: 3rem auto 0;">
                
                <article class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Combien de temps faut-il pour voir des résultats ?
                        <span aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Les premiers résultats sont généralement visibles dès les 30 premiers jours pour le référencement local et les campagnes publicitaires. Pour le SEO organique, comptez 3-6 mois pour des résultats durables et significatifs.</p>
                        </div>
                    </div>
                </article>
                
                <article class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Puis-je changer de phase ou annuler à tout moment ?
                        <span aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Absolument ! Nos contrats sont flexibles. Vous pouvez évoluer vers une phase supérieure ou inférieure selon vos besoins, avec un préavis de 30 jours. Nous nous adaptons à l'évolution de votre business.</p>
                        </div>
                    </div>
                </article>
                
                <article class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Que comprend l'audit gratuit ?
                        <span aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Notre audit inclut : analyse complète de votre site actuel, étude approfondie de la concurrence, audit SEO technique, analyse des réseaux sociaux, et recommandations personnalisées avec un plan d'action prioritaire détaillé.</p>
                        </div>
                    </div>
                </article>
                
                <article class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Travaillez-vous avec toutes les industries ?
                        <span aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Nous avons de l'expérience dans la plupart des secteurs. Cependant, nous nous spécialisons particulièrement dans les PME, l'e-commerce, la santé, l'immobilier et les services professionnels. Chaque stratégie est adaptée aux spécificités de votre secteur.</p>
                        </div>
                    </div>
                </article>
                
                <article class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Proposez-vous des formations ?
                        <span aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Oui ! Nous incluons des formations personnalisées dans tous nos forfaits pour que vous puissiez comprendre et gérer certains aspects de votre présence digitale en autonomie. Formation continue et support inclus.</p>
                        </div>
                    </div>
                </article>
                
                <article class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Quelles garanties offrez-vous ?
                        <span aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Nous garantissons une amélioration mesurable de vos métriques digitales dans les 90 premiers jours, ou nous prolongeons gratuitement nos services jusqu'à l'atteinte des objectifs fixés ensemble.</p>
                        </div>
                    </div>
                </article>
                
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section" id="contact">
        <div class="container">
            <h2 class="text-center text-orange">Contactez-Nous</h2>
            <p class="text-center mb-4">Prêt à transformer votre présence digitale ? Parlons de votre projet !</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                <article class="card text-center">
                    <div class="card-icon" aria-hidden="true">📱</div>
                    <h3>WhatsApp</h3>
                    <p>Pour une réponse rapide et personnalisée</p>
                    <a href="https://wa.me/+33123456789" class="btn btn-primary" target="_blank" rel="noopener">Discuter sur WhatsApp</a>
                </article>
                
                <article class="card text-center">
                    <div class="card-icon" aria-hidden="true">✉️</div>
                    <h3>Email</h3>
                    <p>Pour une demande détaillée par écrit</p>
                    <a href="mailto:contact@viziblix.com" class="btn btn-secondary">Envoyer un Email</a>
                </article>
                
                <article class="card text-center">
                    <div class="card-icon" aria-hidden="true">📞</div>
                    <h3>Appel Découverte</h3>
                    <p>30 min pour discuter de vos besoins</p>
                    <a href="#audit-gratuit" class="btn btn-primary">Planifier un Appel</a>
                </article>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button class="back-to-top" aria-label="Retour en haut de la page" title="Retour en haut">
        <span aria-hidden="true">↑</span>
    </button>
<?php endif; ?>

</main>

<?php get_footer(); ?>
