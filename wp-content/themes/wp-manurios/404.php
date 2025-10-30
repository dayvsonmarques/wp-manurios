<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <main id="main" class="main-content">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="display-1 text-muted">404</h1>
                        <h2 class="card-title"><?php _e('Página não encontrada', 'wp-manurios'); ?></h2>
                        <p class="card-text">
                            <?php _e('Desculpe, mas a página que você está procurando não existe ou foi movida.', 'wp-manurios'); ?>
                        </p>
                        
                        <div class="mt-4">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                <?php _e('Voltar ao início', 'wp-manurios'); ?>
                            </a>
                        </div>
                        
                        <div class="mt-4">
                            <h5><?php _e('Ou tente uma busca:', 'wp-manurios'); ?></h5>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <div class="col-lg-4">
            <aside id="secondary" class="widget-area">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>
