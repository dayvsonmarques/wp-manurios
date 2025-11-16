<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wp-manurios
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '%s', esc_html_x( 'Featured', 'post', '_wp-manurios' ) );
		}
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
	</header>

	<?php _wp_manurios_post_thumbnail(); ?>

	<div <?php _wp_manurios_content_class( 'entry-content' ); ?>>
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<?php _wp_manurios_entry_footer(); ?>
	</footer>

</article>
