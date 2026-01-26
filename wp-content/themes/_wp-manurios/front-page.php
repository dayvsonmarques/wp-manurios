
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
		   </div>
	   </div>
	   <!-- Scroll to next section arrow -->
	   <a href="#about" class="hero-scroll-arrow text-white hover:text-gray-200 transition-all duration-300 cursor-pointer z-20 flex items-center justify-center absolute left-1/2 -translate-x-1/2" style="bottom: 6rem;" aria-label="Ir para próxima seção">
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
				</div>

			</div>
		</div>
	</section>

	<section id="podcast" class="py-20 lg:py-32 bg-green">
		<div class="container mx-auto px-4 lg:px-8">
			<?php
			$spotify_url = trim( (string) get_theme_mod( 'spotify_url', 'https://open.spotify.com/show/6TclgDMrPS66MIj85kTUjX' ) );
			$spotify_embed_url = '';
			$podcast_rss_url = trim( (string) get_theme_mod( 'podcast_rss_url', '' ) );
			$podcast_items = array();
			$spotify_episode_items = array();

			if ( $spotify_url !== '' ) {
				if ( preg_match( '~^https?://open\.spotify\.com/embed/~', $spotify_url ) ) {
					$spotify_embed_url = $spotify_url;
				} elseif ( preg_match( '~^https?://open\.spotify\.com/(show|episode|playlist|album|track)/~', $spotify_url ) ) {
					$spotify_embed_url = preg_replace( '~^https?://open\.spotify\.com/~', 'https://open.spotify.com/embed/', $spotify_url, 1 );
				}
			}

			if ( $podcast_rss_url !== '' ) {
				if ( ! function_exists( 'fetch_feed' ) ) {
					require_once ABSPATH . WPINC . '/feed.php';
				}

				$feed = fetch_feed( $podcast_rss_url );
				if ( ! is_wp_error( $feed ) ) {
					$maxitems = (int) $feed->get_item_quantity( 5 );
					if ( $maxitems > 0 ) {
						$podcast_items = (array) $feed->get_items( 0, $maxitems );
					}
				}
			}

			if ( empty( $podcast_items ) && function_exists( '_wp_manurios_get_spotify_latest_episodes' ) ) {
				$spotify_episode_items = _wp_manurios_get_spotify_latest_episodes( $spotify_url, 5 );
			}
			?>

			<div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
				<div class="space-y-8">
					<div class="inline-flex items-center px-4 py-2 rounded-full bg-brand-gold text-gray-900 font-semibold text-sm uppercase tracking-wide">
						Podcast
					</div>

					<div class="space-y-4">
						<p class="text-white opacity-90 text-lg">Conheça o programa</p>
						<h2 class="text-4xl lg:text-6xl font-bold text-white">Saúde em 1º Lugar</h2>
						<p class="text-white opacity-90 text-lg lg:text-xl leading-relaxed">
							Conversas e reflexões sobre saúde no sentido mais amplo — física, mental, financeira e profissional — com histórias reais e insights práticos.
						</p>
						<p class="text-white opacity-90 text-lg lg:text-xl leading-relaxed">
							Ouça nas principais plataformas e acompanhe os episódios.
						</p>
					</div>

					<div class="flex flex-wrap gap-4">
						<a href="https://www.youtube.com/@saudem1lugar" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 bg-white text-brand-green font-semibold rounded-lg hover:bg-brand-gold hover:text-white transition-all shadow-lg hover:shadow-xl">
							<svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
							</svg>
							<span>Veja no YouTube</span>
						</a>

						<?php if ( ! empty( $spotify_url ) ) : ?>
							<a href="<?php echo esc_url( $spotify_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-brand-green transition-all">
								<span>Ouça no Spotify</span>
							</a>
						<?php endif; ?>
					</div>

					<div class="relative rounded-2xl overflow-hidden shadow-2xl">
						<img
							src="<?php echo esc_url( get_theme_file_uri( 'assets/img/banner-2.jpg' ) ); ?>"
							alt="<?php echo esc_attr__( 'Podcast', '_wp-manurios' ); ?>"
							class="w-full h-auto object-cover"
							loading="lazy"
							decoding="async"
						/>
					</div>
				</div>

				<div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
					<div class="p-6 lg:p-8 flex items-center justify-between gap-6">
						<h3 class="text-2xl lg:text-3xl font-bold text-gray-900">Últimos episódios</h3>
						<div class="flex items-center gap-3">
							<span class="text-gray-500 font-semibold">Spotify</span>
							<svg class="w-10 h-10 text-brand-green" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.52 17.29a.75.75 0 0 1-1.03.25c-2.82-1.73-6.37-2.12-10.55-1.16a.75.75 0 0 1-.34-1.46c4.57-1.05 8.49-.6 11.58 1.3.35.2.46.67.24 1.07zm1.47-3.27a.94.94 0 0 1-1.3.31c-3.23-1.98-8.15-2.55-11.95-1.4a.94.94 0 1 1-.54-1.8c4.34-1.31 9.72-.67 13.45 1.62.44.27.59.85.34 1.27zm.13-3.4c-3.87-2.3-10.26-2.51-13.96-1.38a1.13 1.13 0 0 1-.66-2.16c4.25-1.29 11.31-1.04 15.8 1.63a1.13 1.13 0 0 1-1.18 1.91z"/>
							</svg>
						</div>
					</div>

					<div class="px-6 lg:px-8 pb-6 lg:pb-8">
						<?php if ( ! empty( $podcast_items ) ) : ?>
							<div class="space-y-4">
								<?php foreach ( $podcast_items as $item ) : ?>
									<?php
										$title = (string) $item->get_title();
										$link  = (string) $item->get_permalink();
										$date  = $item->get_date( 'd/m/Y' );

										$thumb_url = '';
										$enclosure = $item->get_enclosure();
										if ( $enclosure && method_exists( $enclosure, 'get_thumbnail' ) ) {
											$thumb_url = (string) $enclosure->get_thumbnail();
										}
									?>
									<div class="p-4 bg-white rounded-xl border border-gray-100 hover:border-brand-green transition-all shadow-lg hover:shadow-2xl">
										<div class="flex items-start gap-4">
											<div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
												<?php if ( $thumb_url !== '' ) : ?>
													<img src="<?php echo esc_url( $thumb_url ); ?>" alt="" class="w-full h-full object-cover" loading="lazy" decoding="async" />
												<?php else : ?>
													<div class="w-full h-full flex items-center justify-center text-gray-400">
														<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-2v13" />
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19a3 3 0 100-6 3 3 0 000 6z" />
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 17a3 3 0 100-6 3 3 0 000 6z" />
														</svg>
													</div>
												<?php endif; ?>
											</div>

											<div class="min-w-0 flex-1">
												<p class="text-xs text-gray-500 mb-1"><?php echo esc_html( $date ?: '' ); ?></p>
												<p class="text-sm font-bold text-gray-900 leading-snug line-clamp-2">
													<?php echo esc_html( $title ); ?>
												</p>
												<div class="pt-2">
													<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold text-sm group">
														<span>Ouça agora</span>
														<svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
														</svg>
													</a>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php elseif ( ! empty( $spotify_episode_items ) ) : ?>
							<div class="space-y-4">
								<?php foreach ( $spotify_episode_items as $episode ) : ?>
									<?php
										$episode_title = isset( $episode['title'] ) ? (string) $episode['title'] : '';
										$episode_url   = isset( $episode['url'] ) ? (string) $episode['url'] : '';
										$episode_thumb = isset( $episode['thumb_url'] ) ? (string) $episode['thumb_url'] : '';
									?>
									<div class="p-4 bg-white rounded-xl border border-gray-100 hover:border-brand-green transition-all shadow-lg hover:shadow-2xl">
										<div class="flex items-start gap-4">
											<div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
												<?php if ( $episode_thumb !== '' ) : ?>
													<img src="<?php echo esc_url( $episode_thumb ); ?>" alt="" class="w-full h-full object-cover" loading="lazy" decoding="async" />
												<?php else : ?>
													<div class="w-full h-full flex items-center justify-center text-gray-400">
														<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-2v13" />
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19a3 3 0 100-6 3 3 0 000 6z" />
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 17a3 3 0 100-6 3 3 0 000 6z" />
														</svg>
													</div>
												<?php endif; ?>
											</div>

											<div class="min-w-0 flex-1">
												<p class="text-xs text-gray-500 mb-1">Spotify</p>
												<p class="text-sm font-bold text-gray-900 leading-snug line-clamp-2">
													<?php echo esc_html( $episode_title ); ?>
												</p>
												<div class="pt-2">
													<a href="<?php echo esc_url( $episode_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold text-sm group">
														<span>Ouça agora</span>
														<svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
														</svg>
													</a>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php elseif ( ! empty( $spotify_embed_url ) ) : ?>
							<iframe
								style="border-radius: 16px;"
								src="<?php echo esc_url( $spotify_embed_url ); ?>"
								width="100%"
								height="660"
								frameborder="0"
								allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
								loading="lazy"
								title="Spotify - Últimos episódios"
							></iframe>
						<?php else : ?>
							<p class="text-gray-600">
								Para exibir 5 episódios compactos, use um link de show do Spotify em Aparência → Personalizar → Links (Home/Redes). Se preferir, você também pode configurar o RSS.
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="features" class="py-10 bg-gray-50">
		<div class="container mx-auto px-4 lg:px-8">
			<?php $book_purchase_url = get_theme_mod( 'book_purchase_url', '' ); ?>
			<div class="text-center mb-16">
				<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Serviços & Produtos</h2>
				<div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Soluções em saúde para promover seu bem-estar integral</p>
			</div>

			<div class="grid features-grid gap-8">
				<div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-yellow-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-gold transition-colors">
						<svg class="w-8 h-8 text-brand-gold group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Palestras</h3>
					<p class="text-gray-600 leading-relaxed">Conteúdos inspiradores sobre saúde física, mental, financeira e profissional para seu evento.</p>
				</div>

				<div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-orange transition-colors">
						<svg class="w-8 h-8 text-brand-orange group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Livro</h3>
					<p class="text-gray-600 leading-relaxed">Acesse o link de compra do livro.</p>
					<?php if ( ! empty( $book_purchase_url ) ) : ?>
						<div class="pt-6">
							<a href="<?php echo esc_url( $book_purchase_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold group">
								<span>Comprar</span>
								<svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
								</svg>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors">
						<svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Serviço 1</h3>
					<p class="text-gray-600 leading-relaxed">Descrição do serviço 1.</p>
				</div>

				<div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
					<div class="w-16 h-16 bg-yellow-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-gold transition-colors">
						<svg class="w-8 h-8 text-brand-gold group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 01-2 2H9a2 2 0 01-2-2m12 0a2 2 0 00-2-2H7a2 2 0 00-2 2m14 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6"></path>
						</svg>
					</div>
					<h3 class="text-2xl font-bold text-gray-900 mb-4">Produto 2</h3>
					<p class="text-gray-600 leading-relaxed">Descrição do produto 2.</p>
				</div>
			</div>
		</div>
	</section>

	<section id="blog" class="py-20 lg:py-32 bg-white">
		<div class="container mx-auto px-4 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Na mídia</h2>
				<div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Confira matérias, entrevistas e conteúdos em destaque</p>
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
						<span>Ver todas as matérias</span>
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

	<div class="section-transition-orange-green"></div>


</main>

<?php
get_footer();
