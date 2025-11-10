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

	<!-- Features Section -->
	<section id="features" class="py-20 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Nossos Serviços</h2>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Soluções completas para elevar seu negócio ao próximo nível</p>
			</div>

			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<!-- Feature 1 -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-blue-200 group">
					<div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors">
						<svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Desenvolvimento Web</h3>
					<p class="text-gray-600 leading-relaxed">Criamos sites e aplicações web responsivas, rápidas e otimizadas para SEO.</p>
				</div>

				<!-- Feature 2 -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-blue-200 group">
					<div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-colors">
						<svg class="w-8 h-8 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Design UI/UX</h3>
					<p class="text-gray-600 leading-relaxed">Interfaces modernas e intuitivas focadas na melhor experiência do usuário.</p>
				</div>

				<!-- Feature 3 -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-blue-200 group">
					<div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-green-600 transition-colors">
						<svg class="w-8 h-8 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Performance</h3>
					<p class="text-gray-600 leading-relaxed">Otimização de velocidade e desempenho para melhor conversão.</p>
				</div>

				<!-- Feature 4 -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-blue-200 group">
					<div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-red-600 transition-colors">
						<svg class="w-8 h-8 text-red-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Segurança</h3>
					<p class="text-gray-600 leading-relaxed">Proteção avançada e conformidade com as melhores práticas de segurança.</p>
				</div>

				<!-- Feature 5 -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-blue-200 group">
					<div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-yellow-600 transition-colors">
						<svg class="w-8 h-8 text-yellow-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Consultoria</h3>
					<p class="text-gray-600 leading-relaxed">Orientação estratégica para maximizar o retorno do investimento digital.</p>
				</div>

				<!-- Feature 6 -->
				<div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-blue-200 group">
					<div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition-colors">
						<svg class="w-8 h-8 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Suporte 24/7</h3>
					<p class="text-gray-600 leading-relaxed">Assistência técnica contínua para garantir o funcionamento perfeito.</p>
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
