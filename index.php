
<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero" id="accueil">
    <div class="container">
        <h1>Transformez Votre Présence Digitale</h1>
        <p class="subtitle">Avec Viziblix, Votre Agence Digitale de Confiance</p>
        <p>Nous aidons les entreprises à prospérer dans le monde numérique grâce à des stratégies sur mesure, des sites web performants et un marketing digital qui génère des résultats concrets.</p>
        <a href="#audit-gratuit" class="btn btn-primary">Obtenez Votre Audit Gratuit</a>
        <a href="#qui-aidons-nous" class="btn btn-secondary">Découvrir Nos Services</a>
    </div>
</section>

<!-- Qui Aidons-Nous Section -->
<section class="section" id="qui-aidons-nous">
    <div class="container">
        <h2 class="text-center text-orange">Qui Aidons-Nous ?</h2>
        <p class="text-center mb-4">Nous accompagnons différents types d'entreprises dans leur transformation digitale</p>
        
        <div class="cards-grid">
            <div class="card fade-in-up">
                <div class="card-icon">🏢</div>
                <h3>PME & Startups</h3>
                <p>Développement de votre présence en ligne avec des solutions adaptées à votre budget et vos objectifs de croissance.</p>
            </div>
            
            <div class="card fade-in-up">
                <div class="card-icon">🛍️</div>
                <h3>E-commerce</h3>
                <p>Création et optimisation de boutiques en ligne performantes pour maximiser vos ventes et fidéliser vos clients.</p>
            </div>
            
            <div class="card fade-in-up">
                <div class="card-icon">⚕️</div>
                <h3>Professionnels de Santé</h3>
                <p>Sites web conformes et stratégies digitales respectueuses de la déontologie médicale.</p>
            </div>
            
            <div class="card fade-in-up">
                <div class="card-icon">🎯</div>
                <h3>Consultants & Coachs</h3>
                <p>Positionnement d'expert et génération de leads qualifiés grâce à une stratégie de contenu efficace.</p>
            </div>
            
            <div class="card fade-in-up">
                <div class="card-icon">🏠</div>
                <h3>Secteur Immobilier</h3>
                <p>Outils digitaux pour présenter vos biens et capturer des prospects qualifiés.</p>
            </div>
            
            <div class="card fade-in-up">
                <div class="card-icon">🎨</div>
                <h3>Artisans & Créateurs</h3>
                <p>Mise en valeur de votre savoir-faire et de vos créations sur des plateformes adaptées.</p>
            </div>
        </div>
    </div>
</section>

<!-- Nos 3 Phases Section -->
<section class="section bg-light" id="nos-3-phases">
    <div class="container">
        <h2 class="text-center text-orange">Nos 3 Phases pour Votre Succès</h2>
        <p class="text-center mb-4">Une approche structurée pour des résultats garantis</p>
        
        <div class="pricing-grid">
            <div class="pricing-card">
                <h3>Phase 1: Fondations</h3>
                <div class="price">
                    1 500€
                    <span class="price-period">/ mois</span>
                </div>
                <ul style="text-align: left; margin: 2rem 0;">
                    <li>✅ Audit complet de votre présence digitale</li>
                    <li>✅ Création/refonte de site web responsive</li>
                    <li>✅ Optimisation SEO de base</li>
                    <li>✅ Configuration Google Analytics & Search Console</li>
                    <li>✅ Stratégie de contenu personnalisée</li>
                    <li>✅ Formation aux outils digitaux</li>
                </ul>
                <a href="#audit-gratuit" class="btn btn-secondary">Commencer</a>
            </div>
            
            <div class="pricing-card featured">
                <h3>Phase 2: Croissance</h3>
                <div class="price">
                    2 500€
                    <span class="price-period">/ mois</span>
                </div>
                <ul style="text-align: left; margin: 2rem 0;">
                    <li>✅ Tout de la Phase 1</li>
                    <li>✅ Campagnes publicitaires Google Ads</li>
                    <li>✅ Gestion réseaux sociaux (2 plateformes)</li>
                    <li>✅ Email marketing automation</li>
                    <li>✅ Création de contenu (blog, vidéos)</li>
                    <li>✅ Lead nurturing avancé</li>
                    <li>✅ Reporting mensuel détaillé</li>
                </ul>
                <a href="#audit-gratuit" class="btn btn-primary">Populaire</a>
            </div>
            
            <div class="pricing-card">
                <h3>Phase 3: Optimisation</h3>
                <div class="price">
                    3 500€
                    <span class="price-period">/ mois</span>
                </div>
                <ul style="text-align: left; margin: 2rem 0;">
                    <li>✅ Tout des Phases 1 & 2</li>
                    <li>✅ Intelligence artificielle et automation</li>
                    <li>✅ Analyse prédictive des performances</li>
                    <li>✅ Optimisation continue basée sur les données</li>
                    <li>✅ Support prioritaire 24/7</li>
                    <li>✅ Stratégies de rétention client</li>
                    <li>✅ Accompagnement stratégique mensuel</li>
                </ul>
                <a href="#audit-gratuit" class="btn btn-secondary">Contactez-nous</a>
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
            <form id="audit-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="submit_audit_form">
                <?php wp_nonce_field('audit_form_nonce', 'audit_nonce'); ?>
                
                <div class="form-group">
                    <label for="full_name">Nom Complet *</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="company">Nom de l'Entreprise *</label>
                    <input type="text" id="company" name="company" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="whatsapp">Numéro WhatsApp *</label>
                    <input type="tel" id="whatsapp" name="whatsapp" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="website">Site Web Actuel</label>
                    <input type="url" id="website" name="website" class="form-control" placeholder="https://votre-site.com">
                </div>
                
                <div class="form-group">
                    <label for="message">Décrivez vos objectifs digitaux</label>
                    <textarea id="message" name="message" class="form-control" rows="4"></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Recevoir Mon Audit Gratuit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- À Propos Section -->
<section class="section" id="a-propos">
    <div class="container">
        <h2 class="text-center text-orange">À Propos de Viziblix</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-top: 3rem;">
            <div>
                <h3>Notre Mission</h3>
                <p>Chez Viziblix, nous croyons que chaque entreprise mérite une présence digitale qui reflète sa valeur et attire ses clients idéaux. Notre équipe d'experts combine créativité, technologie et stratégie pour transformer votre vision en succès mesurable.</p>
                
                <h3>Pourquoi Nous Choisir ?</h3>
                <ul style="margin: 1rem 0;">
                    <li>✅ +150 projets réussis</li>
                    <li>✅ ROI moyen de 300% pour nos clients</li>
                    <li>✅ Support réactif et personnalisé</li>
                    <li>✅ Transparence totale sur nos méthodes</li>
                    <li>✅ Garantie de résultats</li>
                </ul>
            </div>
            <div style="text-align: center;">
                <img src="<?php echo get_template_directory_uri(); ?>/images/team-placeholder.jpg" alt="Équipe Viziblix" style="max-width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section bg-light" id="faq">
    <div class="container">
        <h2 class="text-center text-orange">Questions Fréquentes</h2>
        <div style="max-width: 800px; margin: 3rem auto 0;">
            
            <div class="faq-item">
                <button class="faq-question">
                    Combien de temps faut-il pour voir des résultats ?
                    <span>+</span>
                </button>
                <div class="faq-answer">
                    <p>Les premiers résultats sont généralement visibles dès les 30 premiers jours pour le référencement local et les campagnes publicitaires. Pour le SEO organique, comptez 3-6 mois pour des résultats durables.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Puis-je changer de phase ou annuler à tout moment ?
                    <span>+</span>
                </button>
                <div class="faq-answer">
                    <p>Absolument ! Nos contrats sont flexibles. Vous pouvez évoluer vers une phase supérieure ou inférieure selon vos besoins, avec un préavis de 30 jours.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Que comprend l'audit gratuit ?
                    <span>+</span>
                </button>
                <div class="faq-answer">
                    <p>Notre audit inclut : analyse de votre site actuel, étude de la concurrence, audit SEO, analyse des réseaux sociaux, et recommandations personnalisées avec un plan d'action prioritaire.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Travaillez-vous avec toutes les industries ?
                    <span>+</span>
                </button>
                <div class="faq-answer">
                    <p>Nous avons de l'expérience dans la plupart des secteurs. Cependant, nous nous spécialisons particulièrement dans les PME, l'e-commerce, la santé, l'immobilier et les services professionnels.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Proposez-vous des formations ?
                    <span>+</span>
                </button>
                <div class="faq-answer">
                    <p>Oui ! Nous incluons des formations dans tous nos forfaits pour que vous puissiez comprendre et gérer certains aspects de votre présence digitale en autonomie.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section" id="contact">
    <div class="container">
        <h2 class="text-center text-orange">Contactez-Nous</h2>
        <p class="text-center mb-4">Prêt à transformer votre présence digitale ? Parlons de votre projet !</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
            <div class="card text-center">
                <div class="card-icon">📱</div>
                <h3>WhatsApp</h3>
                <p>Pour une réponse rapide</p>
                <a href="https://wa.me/+33123456789" class="btn btn-primary" target="_blank">Discuter sur WhatsApp</a>
            </div>
            
            <div class="card text-center">
                <div class="card-icon">✉️</div>
                <h3>Email</h3>
                <p>Pour une demande détaillée</p>
                <a href="mailto:contact@viziblix.com" class="btn btn-secondary">Envoyer un Email</a>
            </div>
            
            <div class="card text-center">
                <div class="card-icon">📞</div>
                <h3>Appel Découverte</h3>
                <p>30 min pour discuter de vos besoins</p>
                <a href="#audit-gratuit" class="btn btn-primary">Planifier un Appel</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
