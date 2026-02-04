<?php
/**
 * Template part for displaying about section on front page
 *
 * @package _wp-manurios
 */

$about_page = get_page_by_path( 'sobre', OBJECT, 'page' );
$about_title = 'Sobre';
$about_image = get_theme_file_uri( 'assets/img/banner-1.jpg' );
$about_content = '';

if ( $about_page instanceof WP_Post ) {
	$about_title = get_the_title( $about_page );
	if ( has_post_thumbnail( $about_page ) ) {
		$about_image = get_the_post_thumbnail_url( $about_page, 'full' );
	}
	$about_content = apply_filters( 'the_content', $about_page->post_content );
} else {
	// Fallback content
	$about_content = '
		<p class="text-2xl text-gray-600 leading-relaxed py-2">
			Enfermeira há mais de 20 anos e 1ª enfermeira do Brasil certificada em Medicina do Estilo de Vida pelo IBLM e CBMEV.
		</p>
		<p class="text-2xl text-gray-600 leading-relaxed py-2">
			Venha melhorar seus hábitos de saúde! Palestrante | Especialista em Oncologia | Mentora de Saúde e Bem-Estar | Escritora | Podcast "Saúde em 1º Lugar"
		</p>';
}
?>

<section id="about" class="py-20 lg:py-32 bg-gray-50">
	<div class="container mx-auto px-4 lg:px-8">
		<div class="flex flex-col lg:flex-row lg:flex-nowrap gap-12 lg:gap-16 items-center">
			<div class="relative w-full lg:w-1/3">
				<img
					src="<?php echo esc_url( $about_image ); ?>"
					alt="<?php echo esc_attr( $about_title ); ?>"
					class="w-full h-auto rounded-2xl shadow-2xl"
					loading="lazy"
					decoding="async"
				/>
			</div>

			<div class="about-content text-left lg:w-2/3 min-w-0" aria-label="Sobre Mim">
				<div class="mb-8">
					<h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase"><?php echo esc_html( $about_title ); ?></h2>
					<div class="h-1 w-20 bg-brand-green mb-4"></div>
				</div>

				<div class="space-y-6 text-2xl text-gray-600 leading-relaxed">
					<?php echo $about_content; ?>
				</div>
			</div>
		</div>
	</div>
</section>
