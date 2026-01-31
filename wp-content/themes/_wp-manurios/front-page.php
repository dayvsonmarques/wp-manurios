
<?php

get_header();


?>

<main id="main" class="site-main home ">

	<?php get_template_part( 'template-parts/home/hero' ); ?>

	<?php get_template_part( 'template-parts/content/content', 'about' ); ?>

	<?php get_template_part( 'template-parts/home/podcast' ); ?>

	<?php get_template_part( 'template-parts/home/palestras' ); ?>

	<?php get_template_part( 'template-parts/home/features' ); ?>

	<?php get_template_part( 'template-parts/home/media' ); ?>

	<div class="section-transition-orange-green"></div>


</main>

<?php
get_footer();
