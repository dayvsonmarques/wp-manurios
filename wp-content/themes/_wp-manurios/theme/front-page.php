<?php
/**
 * The front page template file
 *
 * @package _wp-manurios
 */

get_header();
?>

<main id="main" class="site-main">

	<!-- Hero Section -->
	<section class="relative bg-gradient-to-br from-blue-50 via-white to-purple-50 py-20 lg:py-32">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				<div class="space-y-8">
					<h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
						<?php bloginfo( 'name' ); ?>
					</h1>
					<p class="text-xl text-gray-600 leading-relaxed">
						<?php
						$description = get_bloginfo( 'description', 'display' );
						echo $description ? esc_html( $description ) : 'Transforme seu negócio com soluções digitais modernas e inovadoras.';
						?>
					</p>
					<div class="flex flex-col sm:flex-row gap-4">
						<a href="#contact" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-lg hover:shadow-xl">
							<span>Começar Agora</span>
							<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
							</svg>
						</a>
						<a href="#about" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all border-2 border-gray-200">
							<span>Saiba Mais</span>
						</a>
					</div>

					<!-- Stats -->
					<div class="grid grid-cols-3 gap-6 pt-8">
						<div>
							<div class="text-3xl font-bold text-blue-600">10+</div>
							<div class="text-sm text-gray-600">Anos Experiência</div>
						</div>
						<div>
							<div class="text-3xl font-bold text-blue-600">500+</div>
							<div class="text-sm text-gray-600">Projetos</div>
						</div>
						<div>
							<div class="text-3xl font-bold text-blue-600">98%</div>
							<div class="text-sm text-gray-600">Satisfação</div>
						</div>
					</div>
				</div>

				<div class="relative">
					<div class="relative z-10">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/hero-illustration.svg' ); ?>" alt="Hero" class="w-full h-auto" onerror="this.style.display='none'">
					</div>
					<!-- Floating elements -->
					<div class="absolute top-0 right-0 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
					<div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
					<div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
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
	<section id="newsletter" class="py-20 bg-gray-50">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="max-w-3xl mx-auto">
				<div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12">
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
