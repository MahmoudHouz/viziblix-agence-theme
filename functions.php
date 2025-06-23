
<?php
/**
 * Viziblix Enhanced Theme Functions
 * Version: 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme Setup
function viziblix_enhanced_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'navigation-widgets',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Add editor styles
    add_theme_support('editor-styles');
    add_editor_style('style.css');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'viziblix-enhanced'),
        'footer' => esc_html__('Menu Pied de Page', 'viziblix-enhanced'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'viziblix_enhanced_setup');

// Enqueue Scripts and Styles
function viziblix_enhanced_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'viziblix-enhanced-style', 
        get_stylesheet_uri(), 
        array(), 
        wp_get_theme()->get('Version')
    );
    
    // Google Fonts with font-display: swap
    wp_enqueue_style(
        'viziblix-enhanced-fonts', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap', 
        array(), 
        null
    );
    
    // Main theme JavaScript
    wp_enqueue_script(
        'viziblix-enhanced-script', 
        get_template_directory_uri() . '/js/theme.js', 
        array(), 
        wp_get_theme()->get('Version'), 
        true
    );
    
    // Localize script for AJAX and translations
    wp_localize_script('viziblix-enhanced-script', 'viziblix_enhanced_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('viziblix_enhanced_nonce'),
        'strings' => array(
            'menu_open' => __('Ouvrir le menu', 'viziblix-enhanced'),
            'menu_close' => __('Fermer le menu', 'viziblix-enhanced'),
            'loading' => __('Chargement...', 'viziblix-enhanced'),
            'error' => __('Une erreur est survenue', 'viziblix-enhanced'),
        ),
    ));
    
    // Add async/defer attributes to scripts for performance
    add_filter('script_loader_tag', 'viziblix_enhanced_script_attributes', 10, 3);
}
add_action('wp_enqueue_scripts', 'viziblix_enhanced_scripts');

// Add async/defer attributes to scripts
function viziblix_enhanced_script_attributes($tag, $handle, $src) {
    $defer_scripts = array('viziblix-enhanced-script');
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace('<script ', '<script defer ', $tag);
    }
    
    return $tag;
}

// Fallback menu for when no menu is assigned
function viziblix_fallback_menu() {
    echo '<ul id="primary-menu" role="menubar">';
    echo '<li role="none"><a href="#accueil" role="menuitem">Accueil</a></li>';
    echo '<li role="none"><a href="#qui-aidons-nous" role="menuitem">Qui Aidons-Nous</a></li>';
    echo '<li role="none"><a href="#nos-3-phases" role="menuitem">Nos 3 Phases</a></li>';
    echo '<li role="none"><a href="#temoignages" role="menuitem">Témoignages</a></li>';
    echo '<li role="none"><a href="#audit-gratuit" role="menuitem">Audit Gratuit</a></li>';
    echo '<li role="none"><a href="#a-propos" role="menuitem">À Propos</a></li>';
    echo '<li role="none"><a href="#faq" role="menuitem">FAQ</a></li>';
    echo '<li role="none"><a href="#contact" role="menuitem">Contact</a></li>';
    echo '</ul>';
}

// Enhanced audit form submission handler
function handle_enhanced_audit_form_submission() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['audit_nonce'], 'audit_form_nonce')) {
        wp_die(__('Vérification de sécurité échouée', 'viziblix-enhanced'));
    }
    
    // Sanitize and validate form data
    $full_name = sanitize_text_field($_POST['full_name']);
    $company = sanitize_text_field($_POST['company']);
    $whatsapp = sanitize_text_field($_POST['whatsapp']);
    $website = esc_url_raw($_POST['website']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Server-side validation
    $errors = array();
    
    if (empty($full_name)) {
        $errors[] = 'Le nom complet est obligatoire.';
    }
    
    if (empty($company)) {
        $errors[] = 'Le nom de l\'entreprise est obligatoire.';
    }
    
    if (empty($whatsapp)) {
        $errors[] = 'Le numéro WhatsApp est obligatoire.';
    } elseif (!preg_match('/^[\+]?[0-9\s\-\(\)]{8,}$/', $whatsapp)) {
        $errors[] = 'Le format du numéro WhatsApp est invalide.';
    }
    
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        $errors[] = 'L\'URL du site web est invalide.';
    }
    
    if (!empty($errors)) {
        wp_redirect(home_url('/?audit=validation_error&errors=' . urlencode(implode('|', $errors))));
        exit;
    }
    
    // Prepare email content
    $to = get_option('admin_email', 'contact@viziblix.com');
    $subject = sprintf(__('Nouvelle demande d\'audit gratuit de %s', 'viziblix-enhanced'), $full_name);
    
    $body = sprintf(
        __("Nouvelle demande d'audit gratuit reçue via le site web:\n\n" .
        "Nom: %s\n" .
        "Entreprise: %s\n" .
        "WhatsApp: %s\n" .
        "Site Web: %s\n" .
        "Message: %s\n\n" .
        "Date: %s\n" .
        "IP: %s\n" .
        "User Agent: %s", 'viziblix-enhanced'),
        $full_name,
        $company,
        $whatsapp,
        $website ?: 'Non renseigné',
        $message ?: 'Aucun message',
        current_time('mysql'),
        $_SERVER['REMOTE_ADDR'],
        $_SERVER['HTTP_USER_AGENT']
    );
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $full_name . ' <' . (filter_var($whatsapp, FILTER_VALIDATE_EMAIL) ? $whatsapp : get_option('admin_email')) . '>',
    );
    
    // Send email
    $sent = wp_mail($to, $subject, nl2br($body), $headers);
    
    // Store submission in database for backup
    $submission_data = array(
        'full_name' => $full_name,
        'company' => $company,
        'whatsapp' => $whatsapp,
        'website' => $website,
        'message' => $message,
        'submission_date' => current_time('mysql'),
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    );
    
    // Save to custom table or use options table
    $submissions = get_option('viziblix_audit_submissions', array());
    $submissions[] = $submission_data;
    update_option('viziblix_audit_submissions', $submissions);
    
    // Redirect with appropriate message
    if ($sent) {
        wp_redirect(home_url('/?audit=success'));
    } else {
        error_log('Viziblix Enhanced: Failed to send audit form email');
        wp_redirect(home_url('/?audit=error'));
    }
    exit;
}
add_action('admin_post_submit_audit_form', 'handle_enhanced_audit_form_submission');
add_action('admin_post_nopriv_submit_audit_form', 'handle_enhanced_audit_form_submission');

// Add custom body classes for better styling
function viziblix_enhanced_body_classes($classes) {
    if (!is_multi_author()) {
        $classes[] = 'single-author';
    }
    
    if (is_front_page()) {
        $classes[] = 'is-front-page';
    }
    
    // Add browser detection classes
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'Safari') !== false && strpos($user_agent, 'Chrome') === false) {
        $classes[] = 'safari';
    } elseif (strpos($user_agent, 'Chrome') !== false) {
        $classes[] = 'chrome';
    } elseif (strpos($user_agent, 'Firefox') !== false) {
        $classes[] = 'firefox';
    }
    
    return $classes;
}
add_filter('body_class', 'viziblix_enhanced_body_classes');

// Custom excerpt length
function viziblix_enhanced_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'viziblix_enhanced_excerpt_length', 999);

// Custom excerpt more text
function viziblix_enhanced_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'viziblix_enhanced_excerpt_more');

// Remove unnecessary WordPress features for performance
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Optimize WordPress for performance
function viziblix_enhanced_optimize_wp() {
    // Remove query strings from static resources for better caching
    if (!is_admin()) {
        add_filter('script_loader_src', 'viziblix_enhanced_remove_script_version', 15, 1);
        add_filter('style_loader_src', 'viziblix_enhanced_remove_script_version', 15, 1);
    }
    
    // Defer parsing of JavaScript
    add_filter('script_loader_tag', 'viziblix_enhanced_defer_scripts', 10, 3);
}
add_action('init', 'viziblix_enhanced_optimize_wp');

function viziblix_enhanced_remove_script_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

function viziblix_enhanced_defer_scripts($tag, $handle, $src) {
    // List of scripts to defer
    $defer_scripts = array(
        'jquery',
        'viziblix-enhanced-script'
    );
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace('<script ', '<script defer ', $tag);
    }
    
    return $tag;
}

// Security improvements
function viziblix_enhanced_security_improvements() {
    // Hide WordPress version
    remove_action('wp_head', 'wp_generator');
    
    // Disable XML-RPC for security
    add_filter('xmlrpc_enabled', '__return_false');
    
    // Remove WordPress version from RSS feeds
    add_filter('the_generator', '__return_empty_string');
    
    // Remove version from scripts and styles
    add_filter('style_loader_src', 'viziblix_enhanced_remove_wp_version', 9999);
    add_filter('script_loader_src', 'viziblix_enhanced_remove_wp_version', 9999);
}
add_action('init', 'viziblix_enhanced_security_improvements');

function viziblix_enhanced_remove_wp_version($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version'))) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

// Enhanced customizer options
function viziblix_enhanced_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('viziblix_enhanced_contact', array(
        'title'    => __('Informations de Contact', 'viziblix-enhanced'),
        'priority' => 120,
    ));
    
    // WhatsApp number
    $wp_customize->add_setting('whatsapp_number', array(
        'default'           => '+33123456789',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('whatsapp_number', array(
        'label'   => __('Numéro WhatsApp', 'viziblix-enhanced'),
        'section' => 'viziblix_enhanced_contact',
        'type'    => 'text',
    ));
    
    // Email address
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'contact@viziblix.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'   => __('Email de Contact', 'viziblix-enhanced'),
        'section' => 'viziblix_enhanced_contact',
        'type'    => 'email',
    ));
    
    // Brand Colors Section
    $wp_customize->add_section('viziblix_enhanced_colors', array(
        'title'    => __('Couleurs de Marque', 'viziblix-enhanced'),
        'priority' => 130,
    ));
    
    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#f36f21',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'   => __('Couleur Principale', 'viziblix-enhanced'),
        'section' => 'viziblix_enhanced_colors',
    )));
}
add_action('customize_register', 'viziblix_enhanced_customize_register');

// Add support for widgets
function viziblix_enhanced_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Barre Latérale', 'viziblix-enhanced'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Ajoutez des widgets ici.', 'viziblix-enhanced'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Pied de Page', 'viziblix-enhanced'),
        'id'            => 'footer-widgets',
        'description'   => esc_html__('Widgets du pied de page.', 'viziblix-enhanced'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'viziblix_enhanced_widgets_init');

// Enhanced custom post types
function viziblix_enhanced_custom_post_types() {
    // Testimonials post type
    register_post_type('testimonials', array(
        'labels' => array(
            'name'               => __('Témoignages', 'viziblix-enhanced'),
            'singular_name'      => __('Témoignage', 'viziblix-enhanced'),
            'add_new'            => __('Ajouter Nouveau', 'viziblix-enhanced'),
            'add_new_item'       => __('Ajouter Nouveau Témoignage', 'viziblix-enhanced'),
            'edit_item'          => __('Modifier Témoignage', 'viziblix-enhanced'),
            'new_item'           => __('Nouveau Témoignage', 'viziblix-enhanced'),
            'all_items'          => __('Tous les Témoignages', 'viziblix-enhanced'),
            'view_item'          => __('Voir Témoignage', 'viziblix-enhanced'),
            'search_items'       => __('Rechercher Témoignages', 'viziblix-enhanced'),
            'not_found'          => __('Aucun témoignage trouvé', 'viziblix-enhanced'),
            'not_found_in_trash' => __('Aucun témoignage trouvé dans la corbeille', 'viziblix-enhanced'),
        ),
        'public'       => false,
        'show_ui'      => true,
        'has_archive'  => false,
        'supports'     => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon'    => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));
    
    // Projects post type
    register_post_type('projects', array(
        'labels' => array(
            'name'               => __('Projets', 'viziblix-enhanced'),
            'singular_name'      => __('Projet', 'viziblix-enhanced'),
            'add_new'            => __('Ajouter Nouveau', 'viziblix-enhanced'),
            'add_new_item'       => __('Ajouter Nouveau Projet', 'viziblix-enhanced'),
            'edit_item'          => __('Modifier Projet', 'viziblix-enhanced'),
            'new_item'           => __('Nouveau Projet', 'viziblix-enhanced'),
            'all_items'          => __('Tous les Projets', 'viziblix-enhanced'),
            'view_item'          => __('Voir Projet', 'viziblix-enhanced'),
            'search_items'       => __('Rechercher Projets', 'viziblix-enhanced'),
            'not_found'          => __('Aucun projet trouvé', 'viziblix-enhanced'),
            'not_found_in_trash' => __('Aucun projet trouvé dans la corbeille', 'viziblix-enhanced'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-portfolio',
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'projets'),
    ));
}
add_action('init', 'viziblix_enhanced_custom_post_types');

// Add admin menu for theme options
function viziblix_enhanced_admin_menu() {
    add_theme_page(
        __('Options Viziblix Enhanced', 'viziblix-enhanced'),
        __('Options Thème', 'viziblix-enhanced'),
        'manage_options',
        'viziblix-enhanced-options',
        'viziblix_enhanced_options_page'
    );
}
add_action('admin_menu', 'viziblix_enhanced_admin_menu');

// Theme options page
function viziblix_enhanced_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div class="notice notice-info">
            <p><?php _e('Bienvenue dans les options du thème Viziblix Enhanced ! Utilisez le Customizer pour personnaliser l\'apparence de votre site.', 'viziblix-enhanced'); ?></p>
            <p><a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Ouvrir le Customizer', 'viziblix-enhanced'); ?></a></p>
        </div>
        
        <h2><?php _e('Statistiques des Soumissions d\'Audit', 'viziblix-enhanced'); ?></h2>
        <?php
        $submissions = get_option('viziblix_audit_submissions', array());
        $total_submissions = count($submissions);
        ?>
        <p><?php printf(__('Total des soumissions reçues : %d', 'viziblix-enhanced'), $total_submissions); ?></p>
        
        <?php if ($submissions): ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('Date', 'viziblix-enhanced'); ?></th>
                    <th><?php _e('Nom', 'viziblix-enhanced'); ?></th>
                    <th><?php _e('Entreprise', 'viziblix-enhanced'); ?></th>
                    <th><?php _e('WhatsApp', 'viziblix-enhanced'); ?></th>
                    <th><?php _e('Site Web', 'viziblix-enhanced'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_reverse(array_slice($submissions, -10)) as $submission): ?>
                <tr>
                    <td><?php echo esc_html($submission['submission_date']); ?></td>
                    <td><?php echo esc_html($submission['full_name']); ?></td>
                    <td><?php echo esc_html($submission['company']); ?></td>
                    <td><?php echo esc_html($submission['whatsapp']); ?></td>
                    <td><?php echo esc_html($submission['website'] ?: 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <?php
}

// Load text domain for translations
function viziblix_enhanced_load_textdomain() {
    load_theme_textdomain('viziblix-enhanced', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'viziblix_enhanced_load_textdomain');

// Add structured data for SEO
function viziblix_enhanced_structured_data() {
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Viziblix Enhanced',
            'url' => home_url(),
            'logo' => get_template_directory_uri() . '/images/logo.png',
            'description' => 'Agence digitale spécialisée dans la création de sites web et le marketing digital',
            'address' => array(
                '@type' => 'PostalAddress',
                'addressLocality' => 'Paris',
                'addressCountry' => 'FR'
            ),
            'contactPoint' => array(
                '@type' => 'ContactPoint',
                'telephone' => get_theme_mod('whatsapp_number', '+33123456789'),
                'contactType' => 'Customer Service',
                'availableLanguage' => 'French'
            )
        );
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'viziblix_enhanced_structured_data');

// Critical CSS inlining for performance
function viziblix_enhanced_critical_css() {
    if (is_front_page()) {
        echo '<style id="critical-css">';
        echo 'body{font-family:Inter,sans-serif;margin:0;padding:0}';
        echo '.site-header{position:fixed;top:0;width:100%;background:#fff;z-index:1000;box-shadow:0 2px 10px rgba(0,0,0,0.1)}';
        echo '.hero{background:linear-gradient(135deg,#1e1e1e 0%,#2d2d2d 100%);color:#fff;padding:140px 0 80px;text-align:center}';
        echo '.btn-primary{background:#f36f21;color:#fff;padding:15px 30px;border-radius:50px;text-decoration:none}';
        echo '</style>';
    }
}
add_action('wp_head', 'viziblix_enhanced_critical_css', 1);
?>
