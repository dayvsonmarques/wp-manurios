<?php
/**
 * Jadoo Integration Helper Functions
 * 
 * Functions to integrate WordPress menus with Jadoo theme structure
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate Jadoo-compatible footer with WordPress integration
 */
function get_jadoo_footer() {
    // Get site info
    $site_name = get_bloginfo('name');
    $site_url = home_url('/');
    $logo_id = get_theme_mod('custom_logo');
    $logo_url = '';
    
    if ($logo_id) {
        $logo_image = wp_get_attachment_image_src($logo_id, 'full');
        $logo_url = $logo_image ? $logo_image[0] : '';
    }
    
    // Build the footer HTML
    ob_start();
    ?>
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5 bg-primary-gradient">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-7 col-12 mb-4 mb-md-6 mb-lg-0 order-0">
              <?php if ($logo_url): ?>
                <img class="mb-4" src="<?php echo esc_url($logo_url); ?>" width="150" alt="<?php echo esc_attr($site_name); ?>" />
              <?php else: ?>
                <h3 class="text-light mb-4 fw-bold"><?php echo esc_html($site_name); ?></h3>
              <?php endif; ?>
              
              <?php 
              $description = get_bloginfo('description', 'display');
              if ($description) :
              ?>
                <p class="text-light pe-xl-12"><?php echo esc_html($description); ?></p>
              <?php else: ?>
                <p class="text-light pe-xl-12"><?php _e('Explore o mundo com as melhores experiências de viagem. Sua aventura começa aqui.', 'wp-manurios'); ?></p>
              <?php endif; ?>
              
              <div class="icon-group mb-4">
                <a class="text-decoration-none icon-item shadow-social" id="facebook" href="#!"><i class="fab fa-facebook-f"> </i></a>
                <a class="text-decoration-none icon-item shadow-social" id="instagram" href="#!"><i class="fab fa-instagram"> </i></a>
                <a class="text-decoration-none icon-item shadow-social" id="twitter" href="#!"><i class="fab fa-twitter"> </i></a>
              </div>
              
              <h4 class="fw-medium font-sans-serif text-secondary mb-3"><?php _e('Baixe nosso app', 'wp-manurios'); ?></h4>
              <div class="d-flex align-items-center">
                <a href="#!">
                  <img class="me-2" src="<?php echo get_template_directory_uri(); ?>/jadoo/public/assets/img/play-store.png" alt="play store" />
                </a>
                <a href="#!">
                  <img src="<?php echo get_template_directory_uri(); ?>/jadoo/public/assets/img/apple-store.png" alt="apple store" />
                </a>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-1 order-md-2">
              <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4"><?php _e('Empresa', 'wp-manurios'); ?></h4>
              <ul class="list-unstyled mb-0">
                <?php
                if (has_nav_menu('footer')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                        'items_wrap'     => '%3$s',
                        'walker'         => new class extends Walker_Nav_Menu {
                            public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                                $output .= '<li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
                            }
                        }
                    ));
                } else {
                    ?>
                    <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="<?php echo esc_url($site_url); ?>"><?php _e('Início', 'wp-manurios'); ?></a></li>
                    <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!"><?php _e('Sobre', 'wp-manurios'); ?></a></li>
                    <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!"><?php _e('Serviços', 'wp-manurios'); ?></a></li>
                    <?php
                }
                ?>
              </ul>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-2 order-md-3">
              <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4"><?php _e('Contato', 'wp-manurios'); ?></h4>
              <ul class="list-unstyled mb-0">
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="mailto:contato@manurios.com"><?php _e('Ajuda/FAQ', 'wp-manurios'); ?></a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!"><?php _e('Imprensa', 'wp-manurios'); ?></a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!"><?php _e('Afiliados', 'wp-manurios'); ?></a></li>
              </ul>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-3 order-md-4">
              <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4"><?php _e('Mais', 'wp-manurios'); ?></h4>
              <ul class="list-unstyled mb-0">
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php _e('Política de Privacidade', 'wp-manurios'); ?></a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!"><?php _e('Termos de Uso', 'wp-manurios'); ?></a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!"><?php _e('Dicas de Viagem', 'wp-manurios'); ?></a></li>
              </ul>
            </div>
            
            <div class="col-lg-3 col-md-5 col-12 mb-4 mb-md-6 mb-lg-0 order-lg-4 order-md-1">
              <?php if (is_active_sidebar('footer-3')): ?>
                <?php dynamic_sidebar('footer-3'); ?>
              <?php else: ?>
                <div class="icon-group mb-4">
                  <a class="text-decoration-none icon-item shadow-social" id="facebook" href="#!"><i class="fab fa-facebook-f"> </i></a>
                  <a class="text-decoration-none icon-item shadow-social" id="instagram" href="#!"><i class="fab fa-instagram"> </i></a>
                  <a class="text-decoration-none icon-item shadow-social" id="twitter" href="#!"><i class="fab fa-twitter"> </i></a>
                </div>
                <h4 class="fw-medium font-sans-serif text-secondary mb-3"><?php _e('Baixe nosso app', 'wp-manurios'); ?></h4>
                <div class="d-flex align-items-center">
                  <a href="#!">
                    <img class="me-2" src="<?php echo get_template_directory_uri(); ?>/jadoo/public/assets/img/play-store.png" alt="play store" />
                  </a>
                  <a href="#!">
                    <img src="<?php echo get_template_directory_uri(); ?>/jadoo/public/assets/img/apple-store.png" alt="apple store" />
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div><!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

      <div class="py-5 text-center">
        <p class="mb-0 text-secondary fs--1 fw-medium">
          &copy; <?php echo date('Y'); ?> <?php echo esc_html($site_name); ?> - <?php _e('Todos os direitos reservados', 'wp-manurios'); ?>
        </p>
      </div>
    <?php
    return ob_get_clean();
}

/**
 * Generate Jadoo-compatible navigation menu
 */
function get_jadoo_nav_menu() {
    // Get site info
    $site_name = get_bloginfo('name');
    $site_url = home_url('/');
    $logo_id = get_theme_mod('custom_logo');
    $logo_url = '';
    
    if ($logo_id) {
        $logo_image = wp_get_attachment_image_src($logo_id, 'full');
        $logo_url = $logo_image ? $logo_image[0] : '';
    }
    
    // Build the navigation HTML
    ob_start();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url($site_url); ?>">
                <?php if ($logo_url): ?>
                    <img src="<?php echo esc_url($logo_url); ?>" height="34" alt="<?php echo esc_attr($site_name); ?>" />
                <?php else: ?>
                    <?php echo esc_html($site_name); ?>
                <?php endif; ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'walker'         => new Jadoo_Nav_Walker(),
                        'depth'          => 2,
                    ));
                } else {
                    // Fallback menu with sample items
                    ?>
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="<?php echo esc_url($site_url); ?>"><?php _e('Início', 'wp-manurios'); ?></a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#service"><?php _e('Serviços', 'wp-manurios'); ?></a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#destination"><?php _e('Destinos', 'wp-manurios'); ?></a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#booking"><?php _e('Reservas', 'wp-manurios'); ?></a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#testimonial"><?php _e('Depoimentos', 'wp-manurios'); ?></a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="<?php echo wp_login_url(); ?>"><?php _e('Login', 'wp-manurios'); ?></a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="<?php echo wp_registration_url(); ?>"><?php _e('Cadastrar', 'wp-manurios'); ?></a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <?php
    return ob_get_clean();
}

/**
 * Replace Jadoo static menu with WordPress dynamic menu
 */
function integrate_jadoo_dynamic_menu($jadoo_html) {
    if (empty($jadoo_html)) {
        return $jadoo_html;
    }
    
    // Pattern to match the navigation section in Jadoo HTML
    $nav_pattern = '/<nav class="navbar navbar-expand-lg navbar-light fixed-top[^>]*?>.*?<\/nav>/s';
    
    // Get the dynamic navigation menu
    $dynamic_nav = get_jadoo_nav_menu();
    
    // Replace the static navigation with dynamic one
    $jadoo_html = preg_replace($nav_pattern, $dynamic_nav, $jadoo_html);
    
    return $jadoo_html;
}

/**
 * Replace Jadoo static footer with WordPress dynamic footer
 */
function integrate_jadoo_dynamic_footer($jadoo_html) {
    if (empty($jadoo_html)) {
        return $jadoo_html;
    }
    
    // Pattern to match the footer section in Jadoo HTML (from the footer section to the copyright div)
    $footer_pattern = '/<!-- ============================================-->[\s\S]*?<!-- <section> begin ============================-->[\s\S]*?<section class="pt-5 bg-primary-gradient">[\s\S]*?<div class="py-5 text-center">[\s\S]*?<\/div>/s';
    
    // Get the dynamic footer
    $dynamic_footer = get_jadoo_footer();
    
    // Replace the static footer with dynamic one
    $jadoo_html = preg_replace($footer_pattern, $dynamic_footer, $jadoo_html);
    
    return $jadoo_html;
}

/**
 * Extract and process Jadoo main content with dynamic menu and footer
 */
function get_jadoo_content_with_dynamic_menu() {
    $jadoo_file = get_template_directory() . '/jadoo/public/index.html';
    $jadoo_html = '';
    
    if (file_exists($jadoo_file)) {
        $raw = file_get_contents($jadoo_file);
        if (preg_match('/<main[\s\S]*?<\/main>/', $raw, $m)) {
            $jadoo_html = $m[0];
            
            // Integrate dynamic menu
            $jadoo_html = integrate_jadoo_dynamic_menu($jadoo_html);
            
            // Integrate dynamic footer
            $jadoo_html = integrate_jadoo_dynamic_footer($jadoo_html);
            
            // Fix relative asset paths to absolute theme URIs
            $base_uri = get_template_directory_uri() . '/jadoo/public';
            $search = array(
                'href="assets/',
                'src="assets/',
                'src="vendors/',
                'href="vendors/'
            );
            $replace = array(
                'href="' . $base_uri . '/assets/',
                'src="' . $base_uri . '/assets/',
                'src="' . $base_uri . '/vendors/',
                'href="' . $base_uri . '/vendors/'
            );
            $jadoo_html = str_replace($search, $replace, $jadoo_html);
        }
    }
    
    return $jadoo_html;
}

/**
 * Enqueue Jadoo-specific styles and scripts for Jadoo pages
 */
function enqueue_jadoo_assets() {
    if (is_page_template('page-jadoo.php')) {
        // Remove default theme styles to avoid conflicts
        wp_dequeue_style('wp-manurios-style');
        wp_dequeue_style('bootstrap-css');
        
        // Jadoo CSS (this includes Bootstrap and custom styles)
        wp_enqueue_style(
            'jadoo-theme-css',
            get_template_directory_uri() . '/jadoo/public/assets/css/theme.css',
            array(),
            '1.0.0'
        );
        
        // Jadoo integration CSS (to fix any conflicts)
        wp_enqueue_style(
            'jadoo-integration-css',
            get_template_directory_uri() . '/css/jadoo-integration.css',
            array('jadoo-theme-css'),
            '1.0.0'
        );
        
        // Keep Google Fonts
        wp_enqueue_style(
            'wp-manurios-fonts',
            'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap',
            array(),
            null
        );
        
        // Jadoo JS
        wp_enqueue_script(
            'jadoo-bootstrap-navbar-js',
            get_template_directory_uri() . '/jadoo/public/assets/js/bootstrap-navbar.js',
            array('jquery'),
            '1.0.0',
            true
        );
        
        wp_enqueue_script(
            'jadoo-theme-js',
            get_template_directory_uri() . '/jadoo/public/assets/js/theme.min.js',
            array('jquery', 'jadoo-bootstrap-navbar-js'),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_jadoo_assets', 15);

/**
 * Add body class for Jadoo pages
 */
function jadoo_body_class($classes) {
    if (is_page_template('page-jadoo.php')) {
        $classes[] = 'jadoo-landing-page';
    }
    return $classes;
}
add_filter('body_class', 'jadoo_body_class');