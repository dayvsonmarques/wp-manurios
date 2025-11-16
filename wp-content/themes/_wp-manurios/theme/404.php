<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _wp-manurios
 */

get_header();
?>

	<section id="primary">
		<main id="main">

			<div>
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Page Not Found', '_wp-manurios' ); ?></h1>
				</header>

				<div <?php _wp_manurios_content_class( 'page-content' ); ?>>
					<p><?php esc_html_e( 'This page could not be found. It might have been removed or renamed, or it may never have existed.', '_wp-manurios' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>

		</main>
	</section>

<?php
get_footer();
