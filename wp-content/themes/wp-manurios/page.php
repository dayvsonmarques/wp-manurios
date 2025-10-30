<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <main id="main" class="main-content">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card mb-4'); ?>>
                        <div class="card-body">
                            <header class="entry-header">
                                <h1 class="entry-title card-title"><?php the_title(); ?></h1>
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
                            
                            <?php if (comments_open() || get_comments_number()) : ?>
                                <footer class="entry-footer">
                                    <?php comments_template(); ?>
                                </footer>
                            <?php endif; ?>
                        </div>
                    </article>
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
