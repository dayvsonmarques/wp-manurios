<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wp-manurios
 */

$is_home = is_front_page();
$text_class = $is_home ? 'text-white' : 'text-gray-900';
$hover_class = $is_home ? 'hover:text-gray-200' : 'hover:text-blue-600';
$position_class = $is_home ? 'absolute' : 'fixed';
?>

<header id="masthead" class="py-4 <?php echo esc_attr( $position_class ); ?> top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{ mobileMenuOpen: false, scrolled: false }" x-init="
	<?php if ( $is_home ) : ?>
		const checkScroll = () => {
			const aboutSection = document.getElementById('about');
			if (aboutSection) {
				const rect = aboutSection.getBoundingClientRect();
				// Quando a seção about está entrando na viewport (topo dela está próximo ou acima do topo da viewport)
				scrolled = rect.top <= 100;
			} else {
				scrolled = false;
			}
		};
		checkScroll();
	<?php else : ?>
		scrolled = true;
	<?php endif; ?>
" @scroll.window="
	<?php if ( $is_home ) : ?>
		const aboutSection = document.getElementById('about');
		if (aboutSection) {
			const rect = aboutSection.getBoundingClientRect();
			// Quando a seção about está entrando na viewport (topo dela está próximo ou acima do topo da viewport)
			scrolled = rect.top <= 100;
		} else {
			scrolled = false;
		}
	<?php else : ?>
		scrolled = true;
	<?php endif; ?>
" :class="[scrolled || mobileMenuOpen ? 'fixed bg-white shadow-lg' : '']" :style="(scrolled || mobileMenuOpen) ? 'background-color: #ffffff; position: fixed;' : '<?php echo $is_home ? 'background-color: transparent; position: absolute;' : 'background-color: #ffffff; position: fixed;'; ?>'">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="flex items-center justify-between py-3 lg:py-4">
			<div class="flex items-center flex-shrink-0 relative z-[60]">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( $custom_logo_id ) :
					$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					$logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
					if ( empty( $logo_alt ) ) {
						$logo_alt = get_bloginfo( 'name' );
					}
					?>
					<?php if ( is_front_page() ) : ?>
						<h1 class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block">
								<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" class="h-10 lg:h-12 w-auto">
							</a>
						</h1>
					<?php else : ?>
						<p class="site-logo mb-0">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block">
								<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" class="h-10 lg:h-12 w-auto">
							</a>
						</p>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( is_front_page() ) : ?>
						<h1 class="text-3xl lg:text-4xl font-signature">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="transition-colors" :class="(scrolled || mobileMenuOpen) ? 'text-gray-900 hover:text-blue-600' : '<?php echo esc_attr( $text_class . ' ' . $hover_class ); ?>'">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
					<?php else : ?>
						<p class="text-3xl lg:text-4xl font-signature mb-0">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="transition-colors" :class="mobileMenuOpen ? 'text-gray-900 hover:text-blue-600' : '<?php echo esc_attr( $text_class . ' ' . $hover_class ); ?>'">
								<?php bloginfo( 'name' ); ?>
							</a>
						</p>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="hidden lg:flex items-center ml-auto header-nav" aria-label="<?php esc_attr_e( 'Main Navigation', '_wp-manurios' ); ?>" data-is-home="<?php echo $is_home ? 'true' : 'false'; ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'flex items-center space-x-10 font-menu text-lg',
						'container'      => false,
						'fallback_cb'    => '_wp_manurios_nav_menu_fallback',
					)
				);
				?>
			</nav>

			<button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden focus:outline-none ml-auto flex-shrink-0 relative z-[60] transition-colors" :class="(scrolled || mobileMenuOpen) ? 'text-gray-900 hover:text-gray-700' : '<?php echo $is_home ? 'text-white hover:text-gray-200' : 'text-gray-600 hover:text-gray-900'; ?>'" aria-label="<?php esc_attr_e( 'Toggle Menu', '_wp-manurios' ); ?>">
				<svg x-show="!mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
				</svg>
				<svg x-show="mobileMenuOpen" class="mobile-menu-icon w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</div>

		<div x-show="mobileMenuOpen" x-transition class="mobile-menu-overlay lg:hidden fixed inset-0 top-0 bg-white z-50 flex items-center justify-center" @click.away="mobileMenuOpen = false">
			<div class="w-full h-full flex items-center justify-center px-4">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'mobile-menu',
						'menu_class'     => 'flex flex-col items-center justify-center space-y-8 font-menu text-gray-900',
						'container'      => false,
						'fallback_cb'    => '_wp_manurios_nav_menu_fallback',
					)
				);
				?>
			</div>
		</div>
	 </div>
</header>
