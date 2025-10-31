<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php _e('Pular para o conteúdo', 'wp-manurios'); ?></a>

    <?php if (!is_page_template('page-jadoo.php')): ?>
    <header id="masthead" class="site-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <h1 class="site-title mb-0">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="navbar-brand text-decoration-none fw-bold">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php endif; ?>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php _e('Alternar navegação', 'wp-manurios'); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="primary-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'navbar-nav ms-auto',
                        'container'      => false,
                        'fallback_cb'    => 'wp_manurios_fallback_menu',
                        'walker'         => new WP_Manurios_Nav_Walker(),
                    ));
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <?php endif; ?>

    <?php do_action('wp_manurios_before_header'); ?>
    
    <div id="content" class="site-content"<?php if (!is_page_template('page-jadoo.php')) echo ' style="padding-top: 80px;"'; ?>>
