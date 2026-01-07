<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wp-manurios
 */

get_header();
?>

<main id="main" class="site-main">
	<section class="py-20 lg:py-32 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="text-center mb-16">
				<?php
				the_archive_title( '<h1 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">', '</h1>' );
				the_archive_description( '<div class="text-xl text-gray-600 max-w-2xl mx-auto mt-4">', '</div>' );
				?>
				<div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
					?>
						<article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 overflow-hidden group">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="block">
									<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300' ) ); ?>
								</a>
							<?php endif; ?>
							<div class="p-6">
								<h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-brand-green transition-colors">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="text-sm text-gray-500 mb-3">
									<time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
								</div>
								<p class="text-gray-600 leading-relaxed mb-4">
									<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
								</p>
								<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold group/link">
									<span>Ler mais</span>
									<svg class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
									</svg>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<div class="mt-12">
					<?php
					// Paginação
					the_posts_pagination( array(
						'mid_size'  => 2,
						'prev_text' => __( '← Anterior', '_wp-manurios' ),
						'next_text' => __( 'Próxima →', '_wp-manurios' ),
					) );
					?>
				</div>

			<?php else : ?>
				<div class="text-center py-12">
					<p class="text-gray-600 text-lg">Nenhum post encontrado.</p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
