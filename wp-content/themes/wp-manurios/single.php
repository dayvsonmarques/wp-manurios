<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <main id="main" class="main-content">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card mb-4'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-top">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <header class="entry-header">
                                <h1 class="entry-title card-title"><?php the_title(); ?></h1>
                                
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
                                <?php the_content(); ?>
                                
                                <?php
                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . __('Páginas:', 'wp-manurios'),
                                    'after'  => '</div>',
                                ));
                                ?>
                            </div>
                            
                            <footer class="entry-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (has_tag()) : ?>
                                            <div class="tags">
                                                <strong><?php _e('Tags:', 'wp-manurios'); ?></strong>
                                                <?php the_tags('', ', ', ''); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <div class="social-share">
                                            <small class="text-muted"><?php _e('Compartilhar:', 'wp-manurios'); ?></small>
                                            <!-- Add social sharing buttons here if needed -->
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </article>
                    
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                    
                <?php endwhile; ?>
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
