
<?php
/**
 * The front page template file
 *
 * @package _wp-manurios
 */

get_header();

// ...existing code...
?>

<main id="main" class="site-main home ">

	<section class="hero-section relative h-[85vh] min-h-[600px] p-0 overflow-hidden">
	   <?php
	   // Banner slider dentro da hero-section
	   if ( function_exists('_wp_manurios_home_banner_slider') ) {
		   _wp_manurios_home_banner_slider();
	   }
	   ?>
	   <div class="container mx-auto px-4 lg:px-8 w-full absolute top-0 left-0 right-0 z-10 h-full flex items-center">
		   <div class="grid lg:grid-cols-2 gap-12 items-center w-full">
			   <div></div>
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
			   </div>
		   </div>
	   </div>
	   <!-- Scroll to next section arrow -->
	   <a href="#about" class="hero-scroll-arrow text-white hover:text-gray-200 transition-all duration-300 cursor-pointer z-20 flex items-center justify-center absolute bottom-8 left-1/2 -translate-x-1/2" aria-label="Ir para próxima seção">
		   <svg class="w-8 h-8 lg:w-10 lg:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M19 13l-7 7-7-7m14-6l-7 7-7-7"/>
		   </svg>
	   </a>
   </section>

	<?php get_template_part( 'template-parts/content/content', 'about' ); ?>

	<div class="section-transition"></div>

	<section id="palestras" class="py-20 lg:py-32 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
				<div class="video-container relative rounded-2xl overflow-hidden shadow-2xl">
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

				<div class="space-y-6">
					<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">
						Palestras
					</h2>
					<div class="h-1 w-20 bg-brand-green mb-4"></div>
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

			</div>
		</div>
	</section>

	<section id="features" class="py-10 bg-gray-50">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Serviços & Produtos</h2>
				<div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Soluções em saúde para promover seu bem-estar integral</p>
			</div>

			<div class="grid md:grid-cols-3 gap-8">
				<div class="p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors">
						<svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Mentoria</h3>
					<p class="text-gray-600 leading-relaxed">Acompanhamento personalizado para desenvolver hábitos saudáveis e alcançar seus objetivos de bem-estar.</p>
				</div>

				<div class="p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-orange transition-colors">
						<svg class="w-8 h-8 text-brand-orange group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Consultoria</h3>
					<p class="text-gray-600 leading-relaxed">Orientação especializada em saúde integral para transformar sua qualidade de vida de forma sustentável.</p>
				</div>

				<div class="p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-yellow-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-gold transition-colors">
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

	<section id="blog" class="py-20 lg:py-32 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Blog</h2>
				<div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Confira nossos últimos artigos e conteúdos sobre saúde e bem-estar</p>
			</div>

			<?php
			$recent_posts = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'post_status'    => 'publish',
			) );

			if ( $recent_posts->have_posts() ) :
			?>
				<div class="grid md:grid-cols-3 gap-8">
					<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
						<article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 overflow-hidden group flex flex-col">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="block relative overflow-hidden">
									<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500' ) ); ?>
									<div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
								</a>
							<?php else : ?>
								<a href="<?php the_permalink(); ?>" class="block relative overflow-hidden bg-gray-200 h-56 flex items-center justify-center">
									<svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									</svg>
								</a>
							<?php endif; ?>
							<div class="p-8 flex-1 flex flex-col">
								<?php
								$categories = get_the_category();
								if ( ! empty( $categories ) ) :
								?>
									<div class="flex flex-wrap gap-2 mb-3">
										<?php foreach ( array_slice( $categories, 0, 2 ) as $category ) : ?>
											<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="inline-block px-3 py-1 text-xs font-semibold text-brand-green bg-green-50 rounded-full hover:bg-brand-green hover:text-white transition-colors">
												<?php echo esc_html( $category->name ); ?>
											</a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								
								<h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-brand-green transition-colors line-clamp-2">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								
								<div class="flex items-center text-sm text-gray-500 mb-4">
									<svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									</svg>
									<time datetime="<?php echo get_the_date( 'c' ); ?>">
										<?php
										// Formatar data para pt-BR (dd/mm/yyyy)
										$date = get_the_date( 'd/m/Y' );
										echo esc_html( $date );
										?>
									</time>
								</div>
								
								<p class="text-gray-600 leading-relaxed mb-4 flex-1 line-clamp-3">
									<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
								</p>
								
								<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold group/link mt-auto">
									<span>Ler mais</span>
									<svg class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
									</svg>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="text-center mt-16">
					<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>" class="inline-flex items-center px-8 py-4 bg-brand-green text-white font-semibold rounded-lg hover:bg-brand-gold transition-all shadow-lg hover:shadow-xl">
						<span>Ver todos os posts</span>
						<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
						</svg>
					</a>
				</div>
			<?php
			else :
			?>
				<div class="text-center py-12">
					<p class="text-gray-600 text-lg">Nenhum post encontrado ainda.</p>
				</div>
			<?php
			endif;
			wp_reset_postdata();
			?>
		</div>
	</section>

	<section id="newsletter" class="py-20 newsletter-section">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="max-w-3xl mx-auto">
				<div class="p-8 lg:p-12">
					<div class="text-center mb-8">
						<h2 class="text-3xl lg:text-5xl font-bold text-white mb-2 uppercase">Receba novidades</h2>
						<div class="h-1 w-20 bg-white mx-auto mb-4"></div>
						<p class="text-2xl text-white my-6">Inscreva-se em nossa newsletter e receba conteúdos exclusivos, dicas e atualizações direto no seu e-mail.</p>
					</div>

					<form id="newsletter-form" class="space-y-4" x-data="{ submitting: false, message: '', success: false }">
						<div class="flex flex-col sm:flex-row gap-4">
							<input
								type="email"
								name="email"
								required
								placeholder="Seu melhor e-mail"
								class="flex-1 px-6 py-4 bg-white border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all text-lg"
							>
							<button
								type="submit"
								:disabled="submitting"
								class="px-8 py-4 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap"
								x-text="submitting ? 'Enviando...' : 'Inscrever-se'"
							>
								Inscrever-se
							</button>
						</div>

						<div x-show="message" x-transition class="newsletter-message p-4 rounded-lg text-center" :class="success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
							<p x-text="message"></p>
						</div>
					</form>

					<p class="text-sm text-white text-center mt-6">
						<svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
						</svg>
						Seus dados estão seguros conosco. Nunca compartilharemos seu e-mail.
					</p>
				</div>
			</div>
		</div>
	</section>

	<div class="section-transition-orange-green"></div>

	<section id="contact" class="py-28 lg:py-40">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="max-w-4xl mx-auto text-center">
				<h2 class="text-3xl lg:text-5xl font-bold text-white mb-2 uppercase">Contato</h2>
				<div class="h-1 w-20 bg-white mx-auto mb-6"></div>
				<p class="text-3xl text-white/90 my-8 mb-16">Pronto para começar seu projeto? Entre em contato conosco e vamos transformar suas ideias em realidade</p>
				<a href="#" class="inline-flex items-center px-8 py-4 bg-white text-brand-green font-semibold rounded-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl">
					<span>Fale Conosco</span>
					<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
					</svg>
				</a>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
