
<?php get_header(); ?>

<div class="home-hero py-3 py-md-4">
    <div class="container">
        <?php
        if (function_exists('wp_manurios_display_banners_by_position')) {
            // Tenta exibir banner na posição Cabeçalho; se vazio, usa Conteúdo como fallback
            ob_start();
            wp_manurios_display_banners_by_position('header', 1);
            $hero_html = trim(ob_get_clean());
            if (!empty($hero_html)) {
                echo $hero_html;
            } else {
                wp_manurios_display_banners_by_position('content', 1);
            }
        }
        ?>
    </div>
    <?php do_action('wp_manurios_before_content'); ?>
</div>

<div class="main-content container my-4">
<?php the_content(); ?>
</div>

<?php get_footer(); ?>