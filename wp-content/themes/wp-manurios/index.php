<?php
/**
 * The main template file
 */

get_header(); ?>

<div class="container">
    <?php do_action('wp_manurios_before_content'); ?>
    
    <div class="row">
        <div class="col-lg-8">
            <main id="main" class="main-content">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card mb-4'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-img-top">
                                    <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <header class="entry-header">
                                    <h2 class="entry-title card-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <div class="entry-meta">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i>
                                            <?php echo get_the_date(); ?>
                                            <span class="mx-2">|</span>
                                            <i class="bi bi-person"></i>
                                            <?php the_author(); ?>
                                            <span class="mx-2">|</span>
                                            <i class="bi bi-folder"></i>
                                            <?php the_category(', '); ?>
                                        </small>
                                    </div>
                                </header>
                                
                                <div class="entry-content">
                                    <?php
                                    if (is_single()) {
                                        the_content();
                                    } else {
                                        the_excerpt();
                                    }
                                    ?>
                                </div>
                                
                                <?php if (!is_single()) : ?>
                                    <footer class="entry-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                            <?php _e('Leia mais', 'wp-manurios'); ?>
                                        </a>
                                    </footer>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    
                    <?php
                    // Pagination
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('Anterior', 'wp-manurios'),
                        'next_text' => __('Próximo', 'wp-manurios'),
                    ));
                    ?>
                    
                <?php else : ?>
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><?php _e('Nenhum conteúdo encontrado', 'wp-manurios'); ?></h3>
                            <p><?php _e('Desculpe, mas não foi possível encontrar o conteúdo solicitado.', 'wp-manurios'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
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
