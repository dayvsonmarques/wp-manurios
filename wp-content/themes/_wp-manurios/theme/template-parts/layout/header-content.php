<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wp-manurios
 */

$is_home = is_front_page();
$header_class = $is_home ? 'bg-transparent' : 'bg-white shadow-sm';
$text_class = $is_home ? 'text-white' : 'text-gray-900';
$hover_class = $is_home ? 'hover:text-gray-200' : 'hover:text-blue-600';
$position_class = $is_home ? 'absolute' : 'fixed';
?>

<header id="masthead" class="<?php echo esc_attr( $position_class ); ?> top-0 left-0 right-0 z-50 transition-all duration-300 <?php echo esc_attr( $header_class ); ?>" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)" :class="[scrolled ? '<?php echo $is_home ? 'bg-white shadow-lg' : 'shadow-lg'; ?>' : '<?php echo esc_attr( $header_class ); ?>', mobileMenuOpen ? 'bg-white shadow-lg' : '']">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="flex items-center justify-between py-5 lg:py-6">
			<!-- Logo -->
			<div class="flex items-center flex-shrink-0 relative z-[60]">
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
			</div>

			<!-- Desktop Navigation -->
			<nav id="site-navigation" class="hidden lg:flex items-center ml-auto header-nav" aria-label="<?php esc_attr_e( 'Main Navigation', '_wp-manurios' ); ?>" data-is-home="<?php echo $is_home ? 'true' : 'false'; ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'flex items-center space-x-10 font-menu text-lg',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<!-- Mobile Menu Button -->
			<button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden focus:outline-none ml-auto flex-shrink-0 relative z-[60] transition-colors" :class="(scrolled || mobileMenuOpen) ? 'text-gray-900 hover:text-gray-700' : '<?php echo $is_home ? 'text-white hover:text-gray-200' : 'text-gray-600 hover:text-gray-900'; ?>'" aria-label="<?php esc_attr_e( 'Toggle Menu', '_wp-manurios' ); ?>">
				<svg x-show="!mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
				</svg>
				<svg x-show="mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</div>

		<!-- Mobile Menu -->
		<div x-show="mobileMenuOpen" x-transition class="lg:hidden fixed inset-0 top-0 bg-white z-50 flex items-center justify-center" style="display: none;" @click.away="mobileMenuOpen = false">
			<div class="w-full h-full flex items-center justify-center px-4">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'mobile-menu',
						'menu_class'     => 'flex flex-col items-center justify-center space-y-8 font-menu text-gray-900',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
		</div>
	</div>
</header><!-- #masthead -->

<!-- Spacer for fixed header -->
<div class="h-20 lg:h-24"></div>
