<?php
/**
 * Template part for displaying about section on front page
 *
 * @package _wp-manurios
 */
?>

<section id="about" class="py-20 lg:py-32 bg-gray-50">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="flex flex-col lg:flex-row lg:flex-nowrap items-start lg:items-center text-center about-content">
			<div class="flex-1 min-w-0 space-y-6 px-8 lg:px-12" aria-label="Sobre Mim">
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
</section>
