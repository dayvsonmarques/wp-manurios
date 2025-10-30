<?php
/**
 * WP Manurios Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function wp_manurios_setup() {
    // Load theme textdomain
    load_theme_textdomain('wp-manurios', get_template_directory() . '/languages');
    
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
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'wp-manurios'),
        'footer' => __('Menu do Rodapé', 'wp-manurios'),
    ));
}
add_action('after_setup_theme', 'wp_manurios_setup');

// Enqueue scripts and styles
function wp_manurios_scripts() {
    // Google Fonts (Logo: Great Vibes, Headings: Poppins, Body: Inter)
    wp_enqueue_style(
        'wp-manurios-fonts',
        'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap',
        array(),
        null
    );
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array('wp-manurios-fonts'), '5.3.3');
    
    // Theme CSS
    wp_enqueue_style('wp-manurios-style', get_stylesheet_uri(), array('bootstrap-css'), '1.0.0');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);
    
    // Theme JS
    wp_enqueue_script('wp-manurios-js', get_template_directory_uri() . '/js/theme.js', array('bootstrap-js'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'wp_manurios_scripts');

// Register widget areas
function wp_manurios_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'wp-manurios'),
        'id'            => 'sidebar-1',
        'description'   => __('Adicione widgets aqui para aparecer na sidebar.', 'wp-manurios'),
        'before_widget' => '<div id="%1$s" class="widget card mb-3 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="card-header"><h5 class="card-title mb-0">',
        'after_title'   => '</h5></div>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé 1', 'wp-manurios'),
        'id'            => 'footer-1',
        'description'   => __('Primeira coluna do rodapé.', 'wp-manurios'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé 2', 'wp-manurios'),
        'id'            => 'footer-2',
        'description'   => __('Segunda coluna do rodapé.', 'wp-manurios'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé 3', 'wp-manurios'),
        'id'            => 'footer-3',
        'description'   => __('Terceira coluna do rodapé.', 'wp-manurios'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'wp_manurios_widgets_init');

// Custom excerpt length
function wp_manurios_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'wp_manurios_excerpt_length');

// Custom excerpt more
function wp_manurios_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'wp_manurios_excerpt_more');

// Add Bootstrap classes to comment form
function wp_manurios_comment_form_defaults($defaults) {
    $defaults['class_form'] = 'comment-form';
    $defaults['class_submit'] = 'btn btn-primary';
    return $defaults;
}
add_filter('comment_form_defaults', 'wp_manurios_comment_form_defaults');

// Add Bootstrap classes to pagination
function wp_manurios_pagination_args($args) {
    $args['class'] = 'pagination justify-content-center';
    return $args;
}
add_filter('paginate_links_args', 'wp_manurios_pagination_args');

// Fallback menu
function wp_manurios_fallback_menu() {
    echo '<ul class="navbar-nav ms-auto">';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/')) . '">' . __('Início', 'wp-manurios') . '</a></li>';
    echo '</ul>';
}

// Banners desativados a pedido: remover CPT, widgets e menus do admin
// Mantemos um shortcode vazio para evitar quebra em conteúdos existentes
add_shortcode('banners', '__return_empty_string');
