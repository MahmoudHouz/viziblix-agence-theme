
<?php
/**
 * Viziblix Theme Functions
 */

// Theme Setup
function viziblix_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'viziblix'),
    ));
}
add_action('after_setup_theme', 'viziblix_setup');

// Enqueue Scripts and Styles
function viziblix_scripts() {
    wp_enqueue_style('viziblix-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('viziblix-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap', array(), null);
    
    // Enqueue theme JavaScript
    wp_enqueue_script('viziblix-script', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('viziblix-script', 'viziblix_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('viziblix_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'viziblix_scripts');

// Fallback menu for when no menu is assigned
function viziblix_fallback_menu() {
    echo '<ul id="primary-menu">';
    echo '<li><a href="#accueil">Accueil</a></li>';
    echo '<li><a href="#qui-aidons-nous">Qui Aidons-Nous</a></li>';
    echo '<li><a href="#nos-3-phases">Nos 3 Phases</a></li>';
    echo '<li><a href="#audit-gratuit">Audit Gratuit</a></li>';
    echo '<li><a href="#a-propos">À Propos</a></li>';
    echo '<li><a href="#faq">FAQ</a></li>';
    echo '<li><a href="#contact">Contact</a></li>';
    echo '</ul>';
}

// Handle audit form submission
function handle_audit_form_submission() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['audit_nonce'], 'audit_form_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize form data
    $full_name = sanitize_text_field($_POST['full_name']);
    $company = sanitize_text_field($_POST['company']);
    $whatsapp = sanitize_text_field($_POST['whatsapp']);
    $website = esc_url_raw($_POST['website']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Save to database or send email
    $to = 'contact@viziblix.com';
    $subject = 'Nouvelle demande d\'audit gratuit de ' . $full_name;
    $body = "Nouvelle demande d'audit gratuit:\n\n";
    $body .= "Nom: " . $full_name . "\n";
    $body .= "Entreprise: " . $company . "\n";
    $body .= "WhatsApp: " . $whatsapp . "\n";
    $body .= "Site Web: " . $website . "\n";
    $body .= "Message: " . $message . "\n";
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Send email
    $sent = wp_mail($to, $subject, nl2br($body), $headers);
    
    if ($sent) {
        // Redirect with success message
        wp_redirect(home_url('/?audit=success'));
    } else {
        // Redirect with error message
        wp_redirect(home_url('/?audit=error'));
    }
    exit;
}
add_action('admin_post_submit_audit_form', 'handle_audit_form_submission');
add_action('admin_post_nopriv_submit_audit_form', 'handle_audit_form_submission');

// Add custom body classes
function viziblix_body_classes($classes) {
    if (!is_multi_author()) {
        $classes[] = 'single-author';
    }
    
    if (is_front_page()) {
        $classes[] = 'is-front-page';
    }
    
    return $classes;
}
add_filter('body_class', 'viziblix_body_classes');

// Custom excerpt length
function viziblix_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'viziblix_excerpt_length', 999);

// Custom excerpt more
function viziblix_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'viziblix_excerpt_more');

// Remove unnecessary WordPress features
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// Optimize WordPress
function viziblix_optimize_wp() {
    // Remove query strings from static resources
    if (!is_admin()) {
        add_filter('script_loader_src', 'viziblix_remove_script_version', 15, 1);
        add_filter('style_loader_src', 'viziblix_remove_script_version', 15, 1);
    }
}
add_action('init', 'viziblix_optimize_wp');

function viziblix_remove_script_version($src) {
    $parts = explode('?ver', $src);
    return $parts[0];
}

// Security improvements
function viziblix_security_improvements() {
    // Hide WordPress version
    remove_action('wp_head', 'wp_generator');
    
    // Disable XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    // Remove WordPress version from RSS feeds
    add_filter('the_generator', '__return_empty_string');
}
add_action('init', 'viziblix_security_improvements');

// Add theme customizer options
function viziblix_customize_register($wp_customize) {
    // Add section for contact information
    $wp_customize->add_section('viziblix_contact', array(
        'title'    => __('Contact Information', 'viziblix'),
        'priority' => 120,
    ));
    
    // WhatsApp number
    $wp_customize->add_setting('whatsapp_number', array(
        'default'           => '+33123456789',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('whatsapp_number', array(
        'label'   => __('WhatsApp Number', 'viziblix'),
        'section' => 'viziblix_contact',
        'type'    => 'text',
    ));
    
    // Email address
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'contact@viziblix.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'   => __('Contact Email', 'viziblix'),
        'section' => 'viziblix_contact',
        'type'    => 'email',
    ));
}
add_action('customize_register', 'viziblix_customize_register');

// Add support for widgets
function viziblix_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'viziblix'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'viziblix'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'viziblix_widgets_init');

// Add custom post types if needed
function viziblix_custom_post_types() {
    // Testimonials post type
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => 'Témoignages',
            'singular_name' => 'Témoignage',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
    ));
    
    // Projects post type
    register_post_type('projects', array(
        'labels' => array(
            'name' => 'Projets',
            'singular_name' => 'Projet',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
    ));
}
add_action('init', 'viziblix_custom_post_types');
?>
