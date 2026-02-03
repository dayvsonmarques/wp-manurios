<?php

?>
<div class="section-transition"></div>

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
                <div class="space-y-4">
                    <p class="text-white text-base font-semibold tracking-wide uppercase">Conheça o programa</p>
                    <h2 class="text-3xl lg:text-5xl font-bold text-white uppercase">Saúde em 1º Lugar</h2>
                    <p class="text-2xl text-white leading-relaxed">
                        Conversas e reflexões sobre saúde no sentido mais amplo — física, mental, financeira e profissional — com histórias reais e insights práticos.
                    </p>
                    <p class="text-white text-2xl leading-relaxed">
                        Ouça nas principais plataformas e acompanhe os episódios.
                    </p>
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="https://www.youtube.com/@saudem1lugar" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-4 bg-white text-brand-green font-semibold rounded-lg hover:opacity-90 transition-all shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        <span>Veja no YouTube</span>
                    </a>

                    <?php if ( ! empty( $spotify_url ) ) : ?>
                        <a href="<?php echo esc_url( $spotify_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:!text-brand-green transition-all shadow-lg hover:shadow-xl group">
                            <svg class="w-5 h-5 mr-2 transition-colors" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.52 17.29a.75.75 0 0 1-1.03.25c-2.82-1.73-6.37-2.12-10.55-1.16a.75.75 0 0 1-.34-1.46c4.57-1.05 8.49-.6 11.58 1.3.35.2.46.67.24 1.07zm1.47-3.27a.94.94 0 0 1-1.3.31c-3.23-1.98-8.15-2.55-11.95-1.4a.94.94 0 1 1-.54-1.8c4.34-1.31 9.72-.67 13.45 1.62.44.27.59.85.34 1.27zm.13-3.4c-3.87-2.3-10.26-2.51-13.96-1.38a1.13 1.13 0 0 1-.66-2.16c4.25-1.29 11.31-1.04 15.8 1.63a1.13 1.13 0 0 1-1.18 1.91z"/>
                            </svg>
                            <span>Ouça no Spotify</span>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

            <div class="podcast-episodes-panel rounded-2xl shadow-2xl overflow-hidden !pb-8 lg:!pb-12">
                <div class="podcast-episodes-header px-6 lg:px-8 py-8 lg:py-10">
                    <div class="podcast-episodes-header-inner flex items-center justify-between gap-6  py-5">
                        <h3 class="text-2xl lg:text-3xl font-bold text-white">Últimos episódios</h3>
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-white opacity-90" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.52 17.29a.75.75 0 0 1-1.03.25c-2.82-1.73-6.37-2.12-10.55-1.16a.75.75 0 0 1-.34-1.46c4.57-1.05 8.49-.6 11.58 1.3.35.2.46.67.24 1.07zm1.47-3.27a.94.94 0 0 1-1.3.31c-3.23-1.98-8.15-2.55-11.95-1.4a.94.94 0 1 1-.54-1.8c4.34-1.31 9.72-.67 13.45 1.62.44.27.59.85.34 1.27zm.13-3.4c-3.87-2.3-10.26-2.51-13.96-1.38a1.13 1.13 0 0 1-.66-2.16c4.25-1.29 11.31-1.04 15.8 1.63a1.13 1.13 0 0 1-1.18 1.91z"/>
                            </svg>
                            <span class="text-white font-semibold opacity-80 ml-2">Spotify</span>
                        </div>
                    </div>
                </div>

                <div class="px-6 lg:px-8 pb-6 lg:pb-8">
                    <?php if ( ! empty( $podcast_items ) ) : ?>
                        <div class="space-y-4 podcast-episodes-list custom-scrollbar">
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
                                <div class="podcast-episode-item rounded-xl transition-all">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                        <div class="podcast-episode-thumb rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                            <?php if ( $thumb_url !== '' ) : ?>
                                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" class="w-full h-full object-cover" loading="lazy" decoding="async" />
                                            <?php else : ?>
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-2v13" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 17a3 3 0 100-6 3 3 0 000 6z" />
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="min-w-0 flex-1 sm:flex sm:flex-col sm:justify-center sm:min-h-[120px] lg:min-h-[80px]">
                                            <p class="podcast-episode-meta text-xs mb-1"><?php echo esc_html( $date ?: '' ); ?></p>
                                            <p class="podcast-episode-title text-sm font-bold leading-snug line-clamp-2">
                                                <?php echo esc_html( $title ); ?>
                                            </p>
                                            <div class="pt-2">
                                                <a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" class="podcast-episode-link inline-flex items-center font-bold text-base group">
                                                    <span>Ouça agora</span>
                                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
                        <div class="space-y-4 podcast-episodes-list custom-scrollbar">
                            <?php foreach ( $spotify_episode_items as $episode ) : ?>
                                <?php
                                    $episode_title = isset( $episode['title'] ) ? (string) $episode['title'] : '';
                                    $episode_url   = isset( $episode['url'] ) ? (string) $episode['url'] : '';
                                    $episode_thumb = isset( $episode['thumb_url'] ) ? (string) $episode['thumb_url'] : '';
                                ?>
                                <div class="podcast-episode-item rounded-xl transition-all">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                        <div class="podcast-episode-thumb rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                            <?php if ( $episode_thumb !== '' ) : ?>
                                                <img src="<?php echo esc_url( $episode_thumb ); ?>" alt="" class="w-full h-full object-cover" loading="lazy" decoding="async" />
                                            <?php else : ?>
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-2v13" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 17a3 3 0 100-6 3 3 0 000 6z" />
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="min-w-0 flex-1 sm:flex sm:flex-col sm:justify-center sm:min-h-[120px] lg:min-h-[80px]">
                                            <p class="podcast-episode-meta text-xs mb-1">Spotify</p>
                                            <p class="podcast-episode-title text-sm font-bold leading-snug line-clamp-2">
                                                <?php echo esc_html( $episode_title ); ?>
                                            </p>
                                            <div class="pt-2">
                                                <a href="<?php echo esc_url( $episode_url ); ?>" target="_blank" rel="noopener noreferrer" class="podcast-episode-link inline-flex items-center font-bold text-base group">
                                                    <span>Ouça agora</span>
                                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
