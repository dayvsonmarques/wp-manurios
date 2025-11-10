<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wp-manurios
 */

?>

<footer id="colophon" class="bg-white py-12 border-t border-gray-200">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="text-center">
			<p class="text-gray-900 text-lg">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-gray-900 hover:text-blue-600 transition-colors font-semibold">
					<?php bloginfo( 'name' ); ?>
				</a>
				&copy; <?php echo esc_html( date( 'Y' ) ); ?>
			</p>
		</div>
	</div>
</footer><!-- #colophon -->
