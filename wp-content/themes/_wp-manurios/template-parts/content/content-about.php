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
					<p class="text-2xl text-gray-600 leading-relaxed py-5">
						Enfermeira há mais de 20 anos e 1ª enfermeira do Brasil certificada em Medicina do Estilo de Vida pelo IBLM e CBMEV.
					</p>
					<p class="text-2xl text-gray-600 leading-relaxed py-5">
						Venha melhorar seus hábitos de saúde! Palestrante | Especialista em Oncologia | Mentora de Saúde e Bem-Estar | Escritora | Podcast 'Saúde em 1º Lugar'
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
