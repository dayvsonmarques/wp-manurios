<?php
/**
 * Template part for displaying about section on front page
 *
 * @package _wp-manurios
 */
?>

<section id="about" class="py-20 lg:py-32 bg-gray-50">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="flex flex-col lg:flex-row lg:flex-nowrap gap-12 lg:gap-16 items-center">
			<div class="relative rounded-2xl overflow-hidden shadow-2xl w-full lg:w-1/3">
				<img
					src="<?php echo esc_url( get_theme_file_uri( 'assets/img/banner-1.jpg' ) ); ?>"
					alt="<?php echo esc_attr__( 'Sobre', '_wp-manurios' ); ?>"
					class="w-full h-[380px] lg:h-[480px] object-cover object-center"
					loading="lazy"
					decoding="async"
				/>
			</div>

			<div class="about-content text-left lg:w-2/3 min-w-0" aria-label="Sobre Mim">
				<div class="mb-8">
					<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Sobre</h2>
					<div class="h-1 w-20 bg-brand-green mb-4"></div>
				</div>

				<div class="space-y-6">
					<p class="text-3xl text-gray-600 leading-relaxed py-5">
						Enfermeira há mais de 20 anos e 1ª enfermeira do Brasil certificada em Medicina do Estilo de Vida pelo IBLM e CBMEV.
					</p>
					<p class="text-3xl text-gray-600 leading-relaxed py-5">
						Venha melhorar seus hábitos de saúde! Palestrante | Especialista em Oncologia | Mentora de Saúde e Bem-Estar | Escritora | Podcast 'Saúde em 1º Lugar'
					</p>
					<div class="pt-4">
						<a href="<?php echo esc_url(get_permalink(get_page_by_path('sobre')) ?: '#'); ?>" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold text-2xl group">
							<span>Continue lendo</span>
							<svg class="w-6 h-6 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
