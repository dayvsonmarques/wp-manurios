<?php
/**
 * The template for displaying search results pages
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <main id="main" class="main-content">
                <header class="page-header mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="page-title card-title">
                                <?php
                                printf(
                                    /* translators: %s: search query. */
                                    esc_html__('Resultados da busca por: %s', 'wp-manurios'),
                                    '<span>' . get_search_query() . '</span>'
                                );
                                ?>
                            </h1>
                        </div>
                    </div>
                </header>

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card mb-4'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-img-top">
                                    <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
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
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                        <?php _e('Leia mais', 'wp-manurios'); ?>
                                    </a>
                                </footer>
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
                            <h3><?php _e('Nenhum resultado encontrado', 'wp-manurios'); ?></h3>
                            <p><?php _e('Desculpe, mas nada foi encontrado para os termos de busca. Tente novamente com palavras-chave diferentes.', 'wp-manurios'); ?></p>
                            
                            <div class="search-form-wrapper mt-4">
                                <?php get_search_form(); ?>
                            </div>
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
