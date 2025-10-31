<?php
/*
Template Name: Jadoo Landing
*/

get_header();
?>

<div class="jadoo-landing">
    <?php
    // Get Jadoo content with dynamic WordPress menu integration
    $jadoo_html = get_jadoo_content_with_dynamic_menu();
    
    if ($jadoo_html) {
        echo $jadoo_html;
    } else {
        echo '<div class="container my-5"><div class="alert alert-warning">Jadoo content not found.</div></div>';
    }
    ?>
</div>

<?php get_footer(); ?>


