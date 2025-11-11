<?php
/**
 * Template part for displaying about section on front page
 *
 * @package _wp-manurios
 */
?>

<!-- About Section -->
<section id="about" class="py-20 lg:py-32 bg-gray-50">
	<div class="container mx-auto px-4 lg:px-8">
	<div class="flex flex-col lg:flex-row lg:flex-nowrap items-start lg:items-center gap-8">
			<!-- Content Column - Left (flex-1 on large screens) -->
			<div class="flex-1 min-w-0 space-y-6 px-8 lg:px-12" aria-label="Sobre Mim">
				<p class="text-2xl text-gray-600 leading-relaxed">
					Enfermeira há mais de 20 anos e 1ª enfermeira do Brasil certificada em Medicina do Estilo de Vida pelo IBLM e CBMEV.
				</p>
				<p class="text-2xl text-gray-600 leading-relaxed">
					Venha melhorar seus hábitos de saúde! Palestrante | Especialista em Oncologia | Mentora de Saúde e Bem-Estar | Escritora | Podcast 'Saúde em 1º Lugar'
				</p>
				<div class="pt-4">
					<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'sobre' ) ) ?: '#' ); ?>" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold text-2xl group">
						<span>Continue lendo</span>
						<svg class="w-6 h-6 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
						</svg>
					</a>
				</div>
			</div>

			<!-- Spacer Column (blank for visual separation on large screens) -->
			<div class="hidden lg:block flex-shrink-0 w-8"></div>

			<!-- Image Column - Right (fixed ~20vw on large screens, reduced padding + extra right padding on lg) -->
			<div class="w-full lg:w-[20vw] flex-shrink-0 pl-4 pr-4 lg:pl-6 lg:pr-12">
				<?php
				// Get the "Sobre" page and its featured image
				$sobre_page = get_page_by_path( 'sobre' );
				$featured_image_url = '';

				if ( $sobre_page && has_post_thumbnail( $sobre_page->ID ) ) {
					$featured_image_url = get_the_post_thumbnail_url( $sobre_page->ID, 'medium_large' );
				}
				?>
				<div class="rounded-2xl overflow-hidden">
					<?php if ( $featured_image_url ) : ?>
						<img src="<?php echo esc_url( $featured_image_url ); ?>" alt="Sobre <?php bloginfo( 'name' ); ?>" class="w-full h-auto object-contain rounded-2xl">
					<?php else : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about-image.jpg' ); ?>" alt="Sobre <?php bloginfo( 'name' ); ?>" class="w-full h-auto object-contain rounded-2xl" onerror="this.style.display='none'">
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
