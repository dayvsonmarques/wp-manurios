<?php
/**
 * Features / Services Section
 */
?>
<section id="features" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-8">
        <?php $book_purchase_url = get_theme_mod( 'book_purchase_url', '' ); ?>
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Serviços & Produtos</h2>
            <div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
            <p class="text-xl lg:text-2xl text-gray-600 max-w-2xl mx-auto">Soluções em saúde para promover seu bem-estar integral</p>
        </div>

        <style>
            /* Force white icon on hover */
            .features-grid__item.group:hover .service-icon-img { filter: brightness(0) invert(1); }
            .features-grid__item.group:hover .service-icon-svg { color: #ffffff !important; }
        </style>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $args = array(
                'post_type'      => 'mp_service',
                'posts_per_page' => 4,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            );
            $query = new WP_Query( $args );

            // Get available icons definition
            $available_icons = function_exists('_wp_manurios_get_service_icons') ? _wp_manurios_get_service_icons() : array();

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    
                    $icon_url      = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    $service_url   = get_post_meta( get_the_ID(), '_service_url', true );
                    $btn_label     = get_post_meta( get_the_ID(), '_service_btn_label', true );
                    $selected_icon = get_post_meta( get_the_ID(), '_service_icon', true );

                    if ( empty( $btn_label ) ) {
                        $btn_label = 'Saiba mais';
                    }
            ?>
            <div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center flex flex-col items-center h-full">
                <div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors flex-shrink-0">
                    <?php if ( $icon_url ) : ?>
                         <img src="<?php echo esc_url( $icon_url ); ?>" alt="" class="w-8 h-8 object-contain transition-colors service-icon-img" /> 
                    <?php else : 
                        // Determine which SVG path to use
                        $svg_path = 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'; // Default microphone
                        if ( ! empty( $selected_icon ) && isset( $available_icons[ $selected_icon ] ) ) {
                            $svg_path = $available_icons[ $selected_icon ]['svg'];
                        }
                    ?>
                        <svg class="w-8 h-8 text-brand-green transition-colors service-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $svg_path; ?>"></path>
                        </svg>
                    <?php endif; ?>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h3>
                <div class="text-lg text-gray-600 leading-relaxed flex-grow">
                    <?php the_content(); ?>
                </div>
                
                <?php if ( ! empty( $service_url ) ) : ?>
                <div class="mt-8 pt-6 border-t border-gray-100 w-full">
                    <a href="<?php echo esc_url( $service_url ); ?>" class="inline-flex items-center text-brand-green font-bold hover:text-brand-dark transition-colors group-hover:underline">
                        <?php echo esc_html( $btn_label ); ?>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
