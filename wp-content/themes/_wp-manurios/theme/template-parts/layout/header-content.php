<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wp-manurios
 */

?>

<header id="masthead" class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)" :class="scrolled ? 'shadow-lg' : 'shadow-sm'">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="flex items-center justify-between py-4 lg:py-6">
			<!-- Logo -->
			<div class="flex items-center">
				<?php if ( is_front_page() ) : ?>
					<h1 class="text-2xl lg:text-4xl font-signature">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-gray-900 hover:text-blue-600 transition-colors">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				<?php else : ?>
					<p class="text-2xl lg:text-4xl font-signature mb-0">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-gray-900 hover:text-blue-600 transition-colors">
							<?php bloginfo( 'name' ); ?>
						</a>
					</p>
				<?php endif; ?>
			</div>

			<!-- Desktop Navigation -->
			<nav id="site-navigation" class="hidden lg:block ml-auto" aria-label="<?php esc_attr_e( 'Main Navigation', '_wp-manurios' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'flex items-center space-x-8 font-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<!-- Mobile Menu Button -->
			<button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none ml-auto" aria-label="<?php esc_attr_e( 'Toggle Menu', '_wp-manurios' ); ?>">
				<svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
				</svg>
				<svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</div>

		<!-- Mobile Menu -->
		<div x-show="mobileMenuOpen" x-transition class="lg:hidden pb-4" style="display: none;">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'mobile-menu',
					'menu_class'     => 'flex flex-col space-y-4 font-menu',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</div>
	</div>
</header><!-- #masthead -->

<!-- Spacer for fixed header -->
<div class="h-20 lg:h-24"></div>
