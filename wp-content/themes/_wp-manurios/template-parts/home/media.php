<?php

?>
<section id="blog" class="py-20 lg:py-32 bg-white">
    <div class="w-full px-[30px]">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 uppercase mb-2">Na mídia</h2>
            <div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
            <p class="text-2xl lg:text-2xl text-gray-600 max-w-2xl mx-auto">Confira matérias, entrevistas e conteúdos em destaque</p>
        </div>

        <?php
        $midias_query = new WP_Query( array(
            'post_type'      => 'midias-digitais',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'meta_value',
            'meta_key'       => '_midia_date_custom',
            'order'          => 'DESC',
        ) );
        
        if ( ! $midias_query->have_posts() ) {
                $midias_query = new WP_Query( array(
                'post_type'      => 'midias-digitais',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ) );
        }

        if ( $midias_query->have_posts() ) :
        ?>
            <div class="relative group/slider px-4 md:px-12"> 
                <div class="swiper midia-swiper !pb-28" style="--swiper-theme-color: #027c6b; --swiper-pagination-color: #027c6b; --swiper-pagination-bullet-inactive-color: #d1d5db; --swiper-pagination-bullet-inactive-opacity: 1;">
                    <div class="swiper-wrapper">
                    <?php while ( $midias_query->have_posts() ) : $midias_query->the_post(); 
                        $source_name = get_post_meta( get_the_ID(), '_midia_source_name', true );
                        $source_url  = get_post_meta( get_the_ID(), '_midia_source_url', true ) ?: '#';
                        $date_custom = get_post_meta( get_the_ID(), '_midia_date_custom', true );
                        $display_date = $date_custom ? date( 'd/m/Y', strtotime( $date_custom ) ) : get_the_date( 'd/m/Y' );
                        $thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ?: get_template_directory_uri() . '/assets/img/banner-1.jpg';
                    ?>
                        <div class="swiper-slide !h-auto">
                            <article class="h-full bg-white rounded-xl shadow-md hover:shadow-lg transition-all border border-gray-100 overflow-hidden group flex flex-col">
                                <a href="<?php echo esc_url( $source_url ); ?>" target="_blank" class="block relative overflow-hidden h-56">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>

                                <div class="p-8 flex-1 flex flex-col">
                                    <?php if ( $source_name ) : ?>
                                    <div class="mb-3">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-brand-green bg-green-50 rounded-full">
                                            <?php echo esc_html( $source_name ); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-brand-green transition-colors line-clamp-2">
                                        <a href="<?php echo esc_url( $source_url ); ?>" target="_blank"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <div class="flex items-center text-sm text-gray-500 mb-4">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <time>
                                            <?php echo esc_html( $display_date ); ?>
                                        </time>
                                    </div>
                                    
                                    <p class="text-lg text-gray-600 leading-relaxed mb-4 flex-1 line-clamp-3">
                                        <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                                    </p>
                                    
                                    <a href="<?php echo esc_url( $source_url ); ?>" target="_blank" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold group/link mt-auto">
                                        <span>Acessar conteúdo</span>
                                        <svg class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                    </div>
                    
                    <div class="swiper-pagination !bottom-0"></div>
                </div>

                <div class="swiper-button-prev !text-brand-green !w-12 !h-12 !bg-white !rounded-full !shadow-lg hover:!bg-brand-gold hover:!text-white hover:!scale-110 !transition-all after:!text-xl !top-[60%]"></div>
                <div class="swiper-button-next !text-brand-green !w-12 !h-12 !bg-white !rounded-full !shadow-lg hover:!bg-brand-gold hover:!text-white hover:!scale-110 !transition-all after:!text-xl !top-[60%]"></div>
            </div>

        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Nenhuma mídia encontrada no momento.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
        
        <div class="text-center mt-16 hidden">
            <a href="#" class="inline-flex items-center px-8 py-4 bg-brand-green text-white font-semibold rounded-lg hover:bg-brand-gold transition-all shadow-lg hover:shadow-xl">
                <span>Ver mais na mídia</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
