
import React, { useState, useEffect } from 'react';
import { ChevronDown, Menu, X, Zap, Target, Users, Award, Phone, Mail, MapPin, ExternalLink, Check, Star, Globe, Smartphone, TrendingUp } from 'lucide-react';

const Index = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [currentTestimonial, setCurrentTestimonial] = useState(0);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToSection = (sectionId: string) => {
    const element = document.getElementById(sectionId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
      setIsMenuOpen(false);
    }
  };

  const phases = [
    {
      phase: "Phase 1",
      title: "Existence Reveal",
      subtitle: "rendre l'entreprise visible au minimum",
      price: "20 000 FDJ",
      type: "paiement unique",
      features: [
        "Profil Google optimisé",
        "Réseaux sociaux créés (Facebook, Instagram)",
        "Email professionnel",
        "Mini-page de contact type Linktree",
        "1 visuel social media",
        "Analyse express de visibilité"
      ],
      buttonText: "Commencer facilement",
      popular: false
    },
    {
      phase: "Phase 2",
      title: "Site Web & Crédibilité",
      subtitle: "créer une vitrine professionnelle et fiable",
      price: "À partir de 300 000 FDJ",
      type: "selon complexité",
      features: [
        "Site web WordPress professionnel (1 à 5 pages)",
        "Domaine + 2 Emails pro",
        "Formulaire de contact, WhatsApp, Google Maps",
        "Contenu rédigé et optimisé",
        "SEO local de base",
        "Rapport de performance"
      ],
      buttonText: "Créer mon site",
      popular: true
    },
    {
      phase: "Phase 3",
      title: "Croissance & Entretien",
      subtitle: "faire croître et entretenir la visibilité",
      price: "45 000 FDJ",
      type: "/ mois",
      features: [
        "Maintenance du site web",
        "Gestion des emails pro",
        "4 publications / mois (visuels)",
        "1 vidéo pub courte / mois",
        "Optimisation SEO continue",
        "Rapport mensuel"
      ],
      buttonText: "Faire croître mon entreprise",
      popular: false
    }
  ];

  const whoWeHelp = [
    { title: "Magasins & Boutiques", icon: "🛍️" },
    { title: "Restaurants & Cafés", icon: "🍽️" },
    { title: "Freelancers", icon: "💼" },
    { title: "Cliniques & Services", icon: "🏥" }
  ];

  const stats = [
    { number: "50+", label: "Entreprises aidées" },
    { number: "100%", label: "Satisfaction client" },
    { number: "24h", label: "Délai de réponse" }
  ];

  const faqData = [
    {
      question: "Combien de temps faut-il pour créer le site ?",
      answer: "En général, il faut entre 1 à 3 semaines selon la complexité du projet. Nous vous fournirons un planning détaillé dès le début."
    },
    {
      question: "Dois-je fournir les textes et photos ?",
      answer: "Non, nous pouvons nous occuper de la rédaction et utiliser des photos de stock. Si vous avez vos propres contenus, c'est encore mieux !"
    },
    {
      question: "Puis-je garder mon domaine si j'arrête ?",
      answer: "Absolument ! Le nom de domaine vous appartient. Nous vous aidons dans le transfert si nécessaire."
    },
    {
      question: "Est-ce que je peux payer en plusieurs fois ?",
      answer: "Oui, nous proposons des facilités de paiement pour tous nos services. Contactez-nous pour discuter des modalités."
    }
  ];

  return (
    <div className="min-h-screen bg-gray-900 relative overflow-hidden">
      {/* Background Image */}
      <div 
        className="fixed inset-0 z-0 opacity-80"
        style={{
          backgroundImage: `url('/lovable-uploads/0d94a3a6-bfe0-44c9-8cf1-e0f34afc1c2d.png')`,
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          backgroundRepeat: 'no-repeat'
        }}
      />
      
      {/* Overlay for better readability */}
      <div className="fixed inset-0 z-1 bg-black/40" />

      {/* Header with Enhanced Blur Effect */}
      <header className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${
        scrolled 
          ? 'backdrop-blur-xl bg-black/20 shadow-2xl border-b border-white/10' 
          : 'backdrop-blur-lg bg-black/10'
      }`}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-20">
            {/* Logo */}
            <div className="flex items-center space-x-3">
              <img 
                src="/lovable-uploads/391d5718-fe96-4fdf-9c0b-e4db64b01108.png" 
                alt="Viziblix Logo" 
                className="w-12 h-12"
              />
              <span className="text-2xl font-bold text-white">
                Viziblix
              </span>
            </div>

            {/* Desktop Navigation */}
            <nav className="hidden md:flex items-center space-x-8">
              {[
                { name: 'Accueil', id: 'accueil' },
                { name: 'A Propos', id: 'a-propos' },
                { name: 'Services', id: 'services' },
                { name: 'Exemple de site', id: 'exemples' },
                { name: 'Contact', id: 'contact' }
              ].map((item) => (
                <button
                  key={item.name}
                  onClick={() => scrollToSection(item.id)}
                  className="relative text-white/90 hover:text-white transition-colors duration-200 py-2 px-1 group"
                >
                  {item.name}
                  <span className="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                </button>
              ))}
              <button
                onClick={() => scrollToSection('scan-gratuit')}
                className="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-2 rounded-full hover:shadow-xl transform hover:scale-105 transition-all duration-200 backdrop-blur-sm"
              >
                Scan Gratuit
              </button>
            </nav>

            {/* Mobile Menu Button */}
            <button
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              className="md:hidden p-2 rounded-lg backdrop-blur-sm bg-white/10 border border-white/20 text-white"
            >
              {isMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        {isMenuOpen && (
          <div className="md:hidden absolute top-full left-0 right-0 backdrop-blur-xl bg-black/30 border-b border-white/10 shadow-2xl">
            <div className="px-4 py-4 space-y-4">
              {[
                { name: 'Accueil', id: 'accueil' },
                { name: 'A Propos', id: 'a-propos' },
                { name: 'Services', id: 'services' },
                { name: 'Exemple de site', id: 'exemples' },
                { name: 'Contact', id: 'contact' }
              ].map((item) => (
                <button
                  key={item.name}
                  onClick={() => scrollToSection(item.id)}
                  className="block w-full text-left text-white/90 hover:text-white transition-colors duration-200 py-2"
                >
                  {item.name}
                </button>
              ))}
              <button
                onClick={() => scrollToSection('scan-gratuit')}
                className="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-full hover:shadow-xl transition-all duration-200"
              >
                Scan Gratuit
              </button>
            </div>
          </div>
        )}
      </header>

      {/* Hero Section */}
      <section id="accueil" className="relative z-10 pt-32 pb-20 min-h-screen flex items-center">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-8">
            <div className="space-y-4">
              <h1 className="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight">
                Votre présence en ligne
                <br />
                <span className="bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent">
                  commence ici
                </span>
              </h1>
              <p className="text-xl sm:text-2xl text-white/80 max-w-4xl mx-auto leading-relaxed">
                Révélons, construisons et développons la visibilité digitale
                <br />
                des entreprises djiboutiennes
              </p>
            </div>
            <div className="pt-8">
              <button
                onClick={() => scrollToSection('scan-gratuit')}
                className="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-12 py-6 rounded-full text-xl font-semibold hover:shadow-2xl transform hover:scale-105 transition-all duration-300 backdrop-blur-sm border border-orange-400/30"
              >
                Obtenez un scan gratuit de votre visibilité
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* Who We Help Section */}
      <section className="relative z-10 py-20 bg-black/30 backdrop-blur-sm">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold text-white mb-4">
              Qui aidons-nous ?
            </h2>
          </div>
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {whoWeHelp.map((item, index) => (
              <div
                key={index}
                className="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300 text-center group"
              >
                <div className="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">
                  {item.icon}
                </div>
                <h3 className="text-xl font-semibold text-white">{item.title}</h3>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Problems Section */}
      <section className="relative z-10 py-20">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-4xl font-bold text-white mb-12">
            Ces défis vous semblent familiers ?
          </h2>
          <div className="space-y-6 mb-12">
            {[
              "Vos clients ne vous trouvent pas en ligne ?",
              "Pas de site web ? Pas de réseaux sociaux ?",
              "Votre image n'inspire pas confiance ?"
            ].map((problem, index) => (
              <div key={index} className="flex items-center justify-center space-x-4 text-lg text-red-300">
                <X className="h-6 w-6 text-red-400" />
                <span>{problem}</span>
              </div>
            ))}
          </div>
          <div className="bg-gradient-to-r from-orange-500/20 to-orange-600/20 backdrop-blur-sm p-8 rounded-2xl border border-orange-400/30">
            <h3 className="text-2xl font-bold text-white mb-4">
              Alors Viziblix est fait pour vous.
            </h3>
            <p className="text-xl text-white/80">
              Transformons votre invisibilité en présence digitale forte
            </p>
          </div>
        </div>
      </section>

      {/* Method Section */}
      <section id="services" className="relative z-10 py-20 bg-black/40 backdrop-blur-sm">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold text-white mb-4">
              Notre Méthode en 3 Phases
            </h2>
            <p className="text-xl text-white/80 max-w-3xl mx-auto">
              Un parcours structuré pour votre transformation digitale,
              <br />
              étape par étape vers le succès
            </p>
          </div>
          <div className="grid lg:grid-cols-3 gap-8">
            {phases.map((phase, index) => (
              <div
                key={index}
                className={`bg-white/10 backdrop-blur-sm p-8 rounded-2xl border transition-all duration-300 hover:transform hover:scale-105 ${
                  phase.popular 
                    ? 'border-orange-400/50 bg-gradient-to-b from-orange-500/20 to-transparent' 
                    : 'border-white/20 hover:border-white/40'
                }`}
              >
                <div className="text-center mb-6">
                  <div className="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-2xl font-bold text-white mx-auto mb-4">
                    {index + 1}
                  </div>
                  <h3 className="text-2xl font-bold text-white mb-2">{phase.phase}:</h3>
                  <h4 className="text-xl font-semibold text-orange-400 mb-2">{phase.title}</h4>
                  <p className="text-white/60 text-sm">But : {phase.subtitle}</p>
                </div>
                <div className="text-center mb-6">
                  <div className="text-3xl font-bold text-white">{phase.price}</div>
                  <div className="text-white/60">{phase.type}</div>
                </div>
                <ul className="space-y-3 mb-8">
                  {phase.features.map((feature, featureIndex) => (
                    <li key={featureIndex} className="flex items-start space-x-3">
                      <Check className="h-5 w-5 text-orange-400 mt-0.5 flex-shrink-0" />
                      <span className="text-white/80 text-sm">{feature}</span>
                    </li>
                  ))}
                </ul>
                <button className="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-full font-semibold hover:shadow-xl transition-all duration-200">
                  {phase.buttonText}
                </button>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Free Scan CTA */}
      <section className="relative z-10 py-20">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <div className="bg-gradient-to-r from-orange-500/30 to-orange-600/30 backdrop-blur-sm p-12 rounded-3xl border border-orange-400/30">
            <div className="text-6xl mb-6">🎁</div>
            <h2 className="text-4xl font-bold text-white mb-4">
              Scan Gratuit de Visibilité
            </h2>
            <p className="text-xl text-white/80 mb-8">
              Obtenez votre score de visibilité + recommandations en 24h. Gratuit & sans engagement.
            </p>
            <button
              onClick={() => scrollToSection('scan-gratuit')}
              className="bg-white text-orange-600 px-12 py-4 rounded-full text-xl font-semibold hover:shadow-2xl transform hover:scale-105 transition-all duration-300"
            >
              Demander mon scan
            </button>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="relative z-10 py-20 bg-black/30 backdrop-blur-sm">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid md:grid-cols-3 gap-8 text-center">
            {stats.map((stat, index) => (
              <div key={index} className="space-y-2">
                <div className="text-5xl font-bold text-orange-400">{stat.number}</div>
                <div className="text-xl text-white/80">{stat.label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Contact Form Section */}
      <section id="scan-gratuit" className="relative z-10 py-20">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-bold text-white mb-4">
              Audit Gratuit de Votre Visibilité
            </h2>
            <p className="text-xl text-white/80">
              Découvrez où vous en êtes et comment améliorer votre présence en ligne
            </p>
          </div>
          <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
            <form className="space-y-6">
              <div className="grid md:grid-cols-2 gap-6">
                <div>
                  <label className="block text-white font-semibold mb-2">Votre nom *</label>
                  <input
                    type="text"
                    placeholder="Entrez votre nom"
                    className="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-orange-500 backdrop-blur-sm"
                  />
                </div>
                <div>
                  <label className="block text-white font-semibold mb-2">Nom de l'entreprise *</label>
                  <input
                    type="text"
                    placeholder="Nom de votre entreprise"
                    className="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-orange-500 backdrop-blur-sm"
                  />
                </div>
              </div>
              <div className="grid md:grid-cols-2 gap-6">
                <div>
                  <label className="block text-white font-semibold mb-2">Numéro WhatsApp *</label>
                  <input
                    type="tel"
                    placeholder="+253 XX XX XX XX"
                    className="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-orange-500 backdrop-blur-sm"
                  />
                </div>
                <div>
                  <label className="block text-white font-semibold mb-2">Lien actuel (si existant)</label>
                  <input
                    type="url"
                    placeholder="https://votre-site.com ou lien Facebook"
                    className="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-orange-500 backdrop-blur-sm"
                  />
                </div>
              </div>
              <button
                type="submit"
                className="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-200"
              >
                Recevoir mon audit gratuit
              </button>
              <p className="text-white/60 text-sm text-center">
                * Champs obligatoires. Nous vous contactons sous 24h.
              </p>
            </form>
          </div>
        </div>
      </section>

      {/* About Section */}
      <section id="a-propos" className="relative z-10 py-20 bg-black/40 backdrop-blur-sm">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-bold text-white mb-4">
              À propos de Viziblix
            </h2>
          </div>
          <div className="max-w-4xl mx-auto text-center space-y-8">
            <p className="text-xl text-white/80 leading-relaxed">
              Nous aidons les petites entreprises de Djibouti à franchir le pas du digital. 
              Pas besoin de comprendre le web — on s'occupe de tout pour vous, étape par étape.
            </p>
            <p className="text-xl text-white/80 leading-relaxed">
              Notre approche est simple : nous rendons le digital accessible à tous, sans jargon technique, 
              avec des solutions concrètes et des résultats mesurables.
            </p>
            <blockquote className="text-2xl font-semibold text-orange-400 italic">
              "Local, simple, abordable. Notre seul objectif : que vos clients vous trouvent."
            </blockquote>
            <p className="text-lg text-white/60">— Équipe Viziblix</p>
          </div>
        </div>
      </section>

      {/* FAQ Section */}
      <section className="relative z-10 py-20">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold text-white mb-4">
              Questions Fréquentes
            </h2>
            <p className="text-xl text-white/80">Toutes les réponses à vos questions</p>
          </div>
          <div className="space-y-4">
            {faqData.map((faq, index) => (
              <details key={index} className="group bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
                <summary className="flex justify-between items-center cursor-pointer p-6 text-lg font-semibold text-white hover:bg-white/20 transition-colors duration-200">
                  {faq.question}
                  <ChevronDown className="h-5 w-5 text-orange-400 group-open:rotate-180 transition-transform duration-200" />
                </summary>
                <div className="px-6 pb-6">
                  <p className="text-white/80">{faq.answer}</p>
                </div>
              </details>
            ))}
          </div>
          <div className="text-center mt-8">
            <p className="text-white/80 mb-4">Une autre question ? Contactez-nous !</p>
            <div className="flex justify-center space-x-4">
              <button className="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition-colors duration-200">
                WhatsApp
              </button>
              <button className="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors duration-200">
                Email
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer id="contact" className="relative z-10 bg-black/60 backdrop-blur-sm text-white py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid md:grid-cols-4 gap-8 mb-12">
            <div className="space-y-4">
              <div className="flex items-center space-x-3">
                <img 
                  src="/lovable-uploads/391d5718-fe96-4fdf-9c0b-e4db64b01108.png" 
                  alt="Viziblix Logo" 
                  className="w-8 h-8"
                />
                <span className="text-xl font-bold">Viziblix</span>
              </div>
              <p className="text-white/70">
                Nous révélons, construisons et développons la visibilité digitale des entreprises djiboutiennes. 
                Simple, local, efficace.
              </p>
              <p className="text-orange-400 italic">
                "Fier de rendre Djibouti plus visible en ligne."
              </p>
            </div>
            <div>
              <h4 className="font-semibold mb-4 text-orange-400">Liens Rapides</h4>
              <ul className="space-y-2 text-white/70">
                <li><a href="#" className="hover:text-white transition-colors">Phase 1</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Phase 2</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Phase 3</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Audit Gratuit</a></li>
                <li><a href="#" className="hover:text-white transition-colors">FAQ</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Contact</a></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold mb-4 text-orange-400">Contact</h4>
              <div className="space-y-2 text-white/70">
                <div className="flex items-center space-x-2">
                  <Mail className="h-4 w-4" />
                  <span>contact@viziblix.dj</span>
                </div>
                <div className="flex items-center space-x-2">
                  <Phone className="h-4 w-4" />
                  <span>+253 77 41 27 22</span>
                </div>
                <div className="flex items-center space-x-2">
                  <MapPin className="h-4 w-4" />
                  <span>Djibouti, République de Djibouti</span>
                </div>
              </div>
            </div>
            <div>
              <h4 className="font-semibold mb-4 text-orange-400">Consultation gratuite</h4>
              <p className="text-white/70 mb-4">
                Vous ne savez pas quelle phase choisir ? Prenez rendez-vous avec nous.
              </p>
              <button className="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-2 rounded-full hover:shadow-xl transition-all duration-200">
                Consultation gratuite
              </button>
            </div>
          </div>
          <div className="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center text-white/60">
            <p>&copy; 2024 Viziblix. Tous droits réservés.</p>
            <div className="flex space-x-4 mt-4 md:mt-0">
              <a href="#" className="hover:text-white transition-colors">Mentions légales</a>
              <a href="#" className="hover:text-white transition-colors">Politique de confidentialité</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default Index;
