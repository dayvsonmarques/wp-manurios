<?php
/**
 * The front page template file
 *
 * @package _wp-manurios
 */

get_header();
?>

<!-- Remove spacer for home page and add padding for about section -->
<style>
	.home .h-20,
	.home .h-24 { display: none; }

	/* Add padding to about section when header becomes fixed */
	.home.fixed-header-active #about {
		padding-top: 96px; /* Height of header */
	}
</style>

<main id="main" class="site-main">

	<!-- Hero Section -->
	<section class="relative bg-cover bg-center bg-no-repeat h-[85vh] min-h-[600px] flex items-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo esc_url( get_template_directory_uri() . '/assets/img/banner-1.jpg' ); ?>');">
		<div class="container mx-auto px-4 lg:px-8 w-full">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				<!-- Empty column for spacing -->
				<div></div>

				<!-- Content column -->
				<div class="text-center lg:text-center">
					<h1 class="text-4xl lg:text-6xl font-bold text-white leading-tight mb-6">
						Saúde em 1° lugar
					</h1>
					<p class="text-xl lg:text-3xl text-white leading-relaxed mb-8">
						<?php
						$description = get_bloginfo( 'description', 'display' );
						echo $description ? esc_html( $description ) : 'Não espere faltar saúde para cuidar da sua.';
						?>
					</p>
					<div class="flex justify-center lg:justify-start hidden">
						<a href="#about" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-900 font-semibold rounded-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl">
							<span>Saiba Mais</span>
							<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- About Section -->
	<section id="about" class="py-20 lg:py-32 bg-gray-50">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
				<!-- Image/Visual Column -->
				<div class="relative">
					<div class="aspect-square bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl overflow-hidden">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about-image.jpg' ); ?>" alt="Sobre <?php bloginfo( 'name' ); ?>" class="w-full h-full object-cover" onerror="this.style.display='none'">
					</div>
					<!-- Decorative elements -->
					<div class="absolute -bottom-6 -right-6 w-48 h-48 bg-blue-500 rounded-2xl -z-10 opacity-20"></div>
					<div class="absolute -top-6 -left-6 w-32 h-32 bg-purple-500 rounded-full -z-10 opacity-20"></div>
				</div>

				<!-- Content Column -->
				<div class="space-y-6">
					<h2 class="text-3xl lg:text-5xl font-bold text-gray-900">
						Sobre Nós
					</h2>
					<div class="h-1 w-20 bg-blue-600"></div>
					<p class="text-lg lg:text-xl text-gray-600 leading-relaxed">
						Somos especialistas em transformar ideias em realidade digital. Com anos de experiência no mercado, oferecemos soluções completas e personalizadas para elevar seu negócio ao próximo nível.
					</p>
					<p class="text-lg text-gray-600 leading-relaxed">
						Nossa missão é proporcionar a melhor experiência digital para nossos clientes, combinando tecnologia de ponta com design excepcional e estratégias que geram resultados reais.
					</p>
					<div class="pt-4">
						<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'sobre' ) ) ?: '#' ); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-lg group">
							<span>Conheça Nossa História</span>
							<svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Palestras Section -->
	<section id="palestras" class="py-20 lg:py-32 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
				<!-- Content Column -->
				<div class="space-y-6">
					<h2 class="text-3xl lg:text-5xl font-bold text-gray-900">
						Palestras
					</h2>
					<div class="h-1 w-20 bg-brand-green"></div>
					<p class="text-lg lg:text-xl text-gray-600 leading-relaxed">
						Confira mais conversas sobre saúde no seu aspecto mais amplo, desde saúde física e mental, até saúde financeira e profissional, a fim de promover qualidade de vida, bem-estar e longevidade saudável.
					</p>
					<div class="pt-4">
						<a href="https://www.youtube.com/@saudem1lugar" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-8 py-4 bg-brand-green text-white font-semibold rounded-lg hover:bg-brand-gold transition-all shadow-lg hover:shadow-xl">
							<svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
								<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
							</svg>
							<span>Ver Canal no YouTube</span>
						</a>
					</div>
				</div>

				<!-- Video Embed Column -->
				<div class="relative rounded-2xl overflow-hidden shadow-2xl" style="aspect-ratio: 16/9;">
					<iframe
						class="absolute inset-0 w-full h-full"
						src="https://www.youtube.com/embed/o-4QM1vbMes"
						title="Palestra - Saúde em Primeiro Lugar"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin"
						allowfullscreen>
					</iframe>
				</div>
			</div>
		</div>
	</section>

	<!-- Features Section -->
	<section id="features" class="py-20 bg-gray-50">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Serviços</h2>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Soluções em saúde para promover seu bem-estar integral</p>
			</div>

			<div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
				<!-- Mentoria -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group">
					<div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mb-6 group-hover:bg-brand-green transition-colors">
						<svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Mentoria</h3>
					<p class="text-gray-600 leading-relaxed">Acompanhamento personalizado para desenvolver hábitos saudáveis e alcançar seus objetivos de bem-estar.</p>
				</div>

				<!-- Consultoria -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group">
					<div class="w-16 h-16 bg-orange-50 rounded-lg flex items-center justify-center mb-6 group-hover:bg-brand-orange transition-colors">
						<svg class="w-8 h-8 text-brand-orange group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Consultoria</h3>
					<p class="text-gray-600 leading-relaxed">Orientação especializada em saúde integral para transformar sua qualidade de vida de forma sustentável.</p>
				</div>

				<!-- Palestras -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group">
					<div class="w-16 h-16 bg-yellow-50 rounded-lg flex items-center justify-center mb-6 group-hover:bg-brand-gold transition-colors">
						<svg class="w-8 h-8 text-brand-gold group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Palestras</h3>
					<p class="text-gray-600 leading-relaxed">Conteúdos inspiradores sobre saúde física, mental, financeira e profissional para seu evento.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section id="contact" class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="max-w-4xl mx-auto text-center">
				<h2 class="text-3xl lg:text-5xl font-bold text-white mb-6">Pronto para começar seu projeto?</h2>
				<p class="text-xl text-blue-100 mb-8">Entre em contato conosco e vamos transformar suas ideias em realidade</p>
				<a href="#" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl">
					<span>Fale Conosco</span>
					<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
					</svg>
				</a>
			</div>
		</div>
	</section>

	<!-- Newsletter Section -->
	<section id="newsletter" class="py-20 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="max-w-3xl mx-auto">
				<div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12 border border-gray-200">
					<div class="text-center mb-8">
						<h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Receba novidades</h2>
						<p class="text-lg text-gray-600">Inscreva-se em nossa newsletter e receba conteúdos exclusivos, dicas e atualizações direto no seu e-mail.</p>
					</div>

					<form id="newsletter-form" class="space-y-4" x-data="{ submitting: false, message: '', success: false }">
						<div class="flex flex-col sm:flex-row gap-4">
							<input
								type="email"
								name="email"
								required
								placeholder="Seu melhor e-mail"
								class="flex-1 px-6 py-4 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all text-lg"
							>
							<button
								type="submit"
								:disabled="submitting"
								class="px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap"
								x-text="submitting ? 'Enviando...' : 'Inscrever-se'"
							>
								Inscrever-se
							</button>
						</div>

						<div x-show="message" x-transition class="p-4 rounded-lg text-center" :class="success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" style="display: none;">
							<p x-text="message"></p>
						</div>
					</form>

					<p class="text-sm text-gray-500 text-center mt-6">
						<svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
						</svg>
						Seus dados estão seguros conosco. Nunca compartilharemos seu e-mail.
					</p>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
