<?php
/**
 * _wp-manurios functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _wp-manurios
 */

if ( ! defined( '_WP_MANURIOS_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( '_WP_MANURIOS_VERSION', '0.1.0' );
}

if ( ! defined( '_WP_MANURIOS_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `_wp_manurios_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'_WP_MANURIOS_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( '_wp_manurios_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _wp_manurios_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _wp-manurios, use a find and replace
		 * to change '_wp-manurios' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_wp-manurios', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', '_wp-manurios' ),
				'menu-2' => __( 'Footer Menu', '_wp-manurios' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', '_wp_manurios_setup' );

/**
 * Fallback for primary nav when no menu is assigned.
 */
function _wp_manurios_nav_menu_fallback( $args ) {
	$menu_id = '';
	$menu_class = '';

	if ( is_object( $args ) ) {
		$menu_id = isset( $args->menu_id ) ? (string) $args->menu_id : '';
		$menu_class = isset( $args->menu_class ) ? (string) $args->menu_class : '';
	} elseif ( is_array( $args ) ) {
		$menu_id = isset( $args['menu_id'] ) ? (string) $args['menu_id'] : '';
		$menu_class = isset( $args['menu_class'] ) ? (string) $args['menu_class'] : '';
	}

	$menu_id_attr = $menu_id !== '' ? ' id="' . esc_attr( $menu_id ) . '"' : '';
	$menu_class_attr = $menu_class !== '' ? ' class="' . esc_attr( $menu_class ) . '"' : '';

	echo '<ul' . $menu_id_attr . $menu_class_attr . '>';
	
	// Custom One Page Menu Items
	$items = array(
		'#about'     => 'Sobre',
		'#podcast'   => 'Podcasts',
		'#palestras' => 'Palestras',
		'#features'  => 'Serviços & Produtos',
		'#blog'      => 'Na Mídia',
		'#contact'   => 'Contato',
	);

	foreach ( $items as $link => $label ) {
		// If not home, prepend home_url
		$href = is_front_page() ? $link : home_url( '/' ) . $link;
		$section_id = str_replace( '#', '', $link );
		$is_home = is_front_page();
		$initial_text_class = $is_home ? 'text-white' : 'text-gray-900';
		
		// Alpine logic for class binding
		$alpine_class = "activeSection === '$section_id' ? 'text-brand-green font-bold' : ((scrolled || mobileMenuOpen) ? 'text-gray-900' : '$initial_text_class')";

		echo '<li class="menu-item"><a href="' . esc_url( $href ) . '" class="transition-colors duration-300 hover:opacity-75" :class="' . $alpine_class . '">' . esc_html( $label ) . '</a></li>';
	}
	
	echo '</ul>';
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _wp_manurios_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', '_wp-manurios' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', '_wp-manurios' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_wp_manurios_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _wp_manurios_scripts() {
	// Google Fonts - Ubuntu e Ubuntu Mono
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&family=Ubuntu+Mono:wght@400;700&display=swap', array(), null );

	// Main theme stylesheet (Tailwind)
	$style_css_path = get_stylesheet_directory() . '/style.css';
	$style_css_ver  = file_exists( $style_css_path ) ? (string) filemtime( $style_css_path ) : _WP_MANURIOS_VERSION;
	wp_enqueue_style( '_wp-manurios-style', get_stylesheet_uri(), array(), $style_css_ver );
	
	// Compiled SCSS styles (loaded after Tailwind to override)
	$main_css_path = get_template_directory() . '/css/main.css';
	$main_css_ver  = file_exists( $main_css_path ) ? (string) filemtime( $main_css_path ) : ( _WP_MANURIOS_VERSION . '-scss' );
	wp_enqueue_style( '_wp-manurios-scss', get_template_directory_uri() . '/css/main.css', array( '_wp-manurios-style' ), $main_css_ver );
	
	wp_enqueue_script( '_wp-manurios-script', get_template_directory_uri() . '/js/script.min.js', array(), _WP_MANURIOS_VERSION, true );

	wp_add_inline_script(
		'_wp-manurios-script',
		"(function(){\n" .
		"  function ready(fn){ if(document.readyState!=='loading'){ fn(); } else { document.addEventListener('DOMContentLoaded', fn); } }\n" .
		"  ready(function(){\n" .
		"    var contactBtn = document.getElementById('btn-contact-me');\n" .
		"    if(!contactBtn) return;\n" .
		"    var whatsappBtn = document.getElementById('btn-whatsapp-float') || document.querySelector('a[aria-label=\"Contato via WhatsApp\"]');\n" .
		"    if(!whatsappBtn) return;\n" .
		"    contactBtn.addEventListener('click', function(e){\n" .
		"      e.preventDefault();\n" .
		"      whatsappBtn.click();\n" .
		"    });\n" .
		"  });\n" .
		"})();\n"
	);

	// Alpine.js for interactive components
	wp_enqueue_script( 'alpinejs', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), '3.x.x', true );
	wp_script_add_data( 'alpinejs', 'defer', true );

	// Swiper Slider (Global load to ensure visibility)
	wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
	wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
	
	// Custom Swiper Init
	wp_enqueue_script( 'swiper-init', get_template_directory_uri() . '/js/swiper-init.js', array('swiper-js'), _WP_MANURIOS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_wp_manurios_scripts' );

/**
 * Enqueue the block editor script.
 */
function _wp_manurios_enqueue_block_editor_script() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'_wp-manurios-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			_WP_MANURIOS_VERSION,
			true
		);
		wp_add_inline_script( '_wp-manurios-editor', "tailwindTypographyClasses = '" . esc_attr( _WP_MANURIOS_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', '_wp_manurios_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function _wp_manurios_tinymce_add_class( $settings ) {
	$settings['body_class'] = _WP_MANURIOS_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', '_wp_manurios_tinymce_add_class' );

/**
 * Limit the block editor to heading levels supported by Tailwind Typography.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $block_type Block type name including namespace.
 * @return array
 */
function _wp_manurios_modify_heading_levels( $args, $block_type ) {
	if ( 'core/heading' !== $block_type ) {
		return $args;
	}

	// Remove <h1>, <h5> and <h6>.
	$args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );

	return $args;
}
add_filter( 'register_block_type_args', '_wp_manurios_modify_heading_levels', 10, 2 );

/**
 * Add WhatsApp settings to Customizer
 */
function _wp_manurios_customize_register( $wp_customize ) {
	// Add WhatsApp Section
	$wp_customize->add_section( 'whatsapp_settings', array(
		'title'    => __( 'WhatsApp Flutuante', '_wp-manurios' ),
		'priority' => 30,
	) );

	// WhatsApp Phone Number
	$wp_customize->add_setting( 'whatsapp_phone', array(
		'default'           => '5511999999999',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'whatsapp_phone', array(
		'label'       => __( 'Número do WhatsApp', '_wp-manurios' ),
		'description' => __( 'Digite o número com código do país (ex: 5511999999999)', '_wp-manurios' ),
		'section'     => 'whatsapp_settings',
		'type'        => 'text',
	) );

	// WhatsApp Message
	$wp_customize->add_setting( 'whatsapp_message', array(
		'default'           => 'Olá! Gostaria de saber mais sobre seus serviços.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'whatsapp_message', array(
		'label'       => __( 'Mensagem Padrão', '_wp-manurios' ),
		'description' => __( 'Mensagem que será enviada ao clicar no botão', '_wp-manurios' ),
		'section'     => 'whatsapp_settings',
		'type'        => 'textarea',
	) );

	// Links Section
	$wp_customize->add_section( 'links_settings', array(
		'title'    => __( 'Links (Home/Redes)', '_wp-manurios' ),
		'priority' => 31,
	) );

	// Spotify URL
	$wp_customize->add_setting( 'spotify_url', array(
		'default'           => 'https://open.spotify.com/show/6TclgDMrPS66MIj85kTUjX',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'spotify_url', array(
		'label'       => __( 'URL do Spotify', '_wp-manurios' ),
		'description' => __( 'Link do perfil/playlist no Spotify', '_wp-manurios' ),
		'section'     => 'links_settings',
		'type'        => 'url',
	) );

	// Book purchase URL
	$wp_customize->add_setting( 'book_purchase_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'book_purchase_url', array(
		'label'       => __( 'URL de compra do Livro', '_wp-manurios' ),
		'description' => __( 'Link para a página de compra (Amazon/Hotmart/etc.)', '_wp-manurios' ),
		'section'     => 'links_settings',
		'type'        => 'url',
	) );

	// Podcast RSS URL
	$wp_customize->add_setting( 'podcast_rss_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'podcast_rss_url', array(
		'label'       => __( 'RSS do Podcast (para listar episódios)', '_wp-manurios' ),
		'description' => __( 'Opcional. Se você tiver um feed RSS do podcast, cole aqui para exibir os 5 últimos episódios em lista compacta na home. Caso contrário, o site tenta montar a lista a partir do link do Spotify.', '_wp-manurios' ),
		'section'     => 'links_settings',
		'type'        => 'url',
	) );

	// Logo Section (using WordPress default custom-logo support)
	// The logo option will appear in "Site Identity" section automatically
}
add_action( 'customize_register', '_wp_manurios_customize_register' );


/**
 * Register Custom Post Types: Newsletter & Banner
 */
function _wp_manurios_register_custom_post_types() {
       // Newsletter CPT (mantido)
       $newsletter_labels = array(
	       'name'                  => __( 'Newsletter Subscribers', '_wp-manurios' ),
	       'singular_name'         => __( 'Subscriber', '_wp-manurios' ),
	       'menu_name'             => __( 'Newsletter', '_wp-manurios' ),
	       'name_admin_bar'        => __( 'Subscriber', '_wp-manurios' ),
	       'add_new'               => __( 'Add New', '_wp-manurios' ),
	       'add_new_item'          => __( 'Add New Subscriber', '_wp-manurios' ),
	       'new_item'              => __( 'New Subscriber', '_wp-manurios' ),
	       'edit_item'             => __( 'Edit Subscriber', '_wp-manurios' ),
	       'view_item'             => __( 'View Subscriber', '_wp-manurios' ),
	       'all_items'             => __( 'All Subscribers', '_wp-manurios' ),
	       'search_items'          => __( 'Search Subscribers', '_wp-manurios' ),
	       'not_found'             => __( 'No subscribers found.', '_wp-manurios' ),
	       'not_found_in_trash'    => __( 'No subscribers found in Trash.', '_wp-manurios' ),
       );
       $newsletter_args = array(
	       'labels'             => $newsletter_labels,
	       'public'             => false,
	       'publicly_queryable' => false,
	       'show_ui'            => true,
	       'show_in_menu'       => true,
	       'menu_icon'          => 'dashicons-email-alt',
	       'menu_position'      => 25,
	       'query_var'          => false,
	       'rewrite'            => false,
	       'capability_type'    => 'post',
	       'has_archive'        => false,
	       'hierarchical'       => false,
	       'supports'           => array( 'title' ),
       );
       register_post_type( 'newsletter', $newsletter_args );

       // Banner CPT
       $banner_labels = array(
	       'name'                  => __( 'Banners', '_wp-manurios' ),
	       'singular_name'         => __( 'Banner', '_wp-manurios' ),
	       'menu_name'             => __( 'Banners', '_wp-manurios' ),
	       'name_admin_bar'        => __( 'Banner', '_wp-manurios' ),
	       'add_new'               => __( 'Add New', '_wp-manurios' ),
	       'add_new_item'          => __( 'Add New Banner', '_wp-manurios' ),
	       'new_item'              => __( 'New Banner', '_wp-manurios' ),
	       'edit_item'             => __( 'Edit Banner', '_wp-manurios' ),
	       'view_item'             => __( 'View Banner', '_wp-manurios' ),
	       'all_items'             => __( 'All Banners', '_wp-manurios' ),
	       'search_items'          => __( 'Search Banners', '_wp-manurios' ),
	       'not_found'             => __( 'No banners found.', '_wp-manurios' ),
	       'not_found_in_trash'    => __( 'No banners found in Trash.', '_wp-manurios' ),
       );
       $banner_args = array(
	       'labels'             => $banner_labels,
	       'public'             => true,
	       'publicly_queryable' => true,
	       'show_ui'            => true,
	       'show_in_menu'       => true,
	       'menu_icon'          => 'dashicons-images-alt2',
	       'menu_position'      => 20,
	       'query_var'          => true,
	       'rewrite'            => array( 'slug' => 'banner' ),
	       'capability_type'    => 'post',
	       'has_archive'        => false,
	       'hierarchical'       => false,
	       'supports'           => array( 'title', 'editor', 'thumbnail' ),
       );
       register_post_type( 'banner', $banner_args );
}
add_action( 'init', '_wp_manurios_register_custom_post_types' );

/**
 * Banner: Adiciona campos extras (link)
 */
function _wp_manurios_banner_meta_box() {
       add_meta_box(
	       'banner_link',
	       __( 'Banner Link', '_wp-manurios' ),
	       '_wp_manurios_banner_link_callback',
	       'banner',
	       'normal',
	       'default'
       );
}
add_action( 'add_meta_boxes', '_wp_manurios_banner_meta_box' );

function _wp_manurios_banner_link_callback( $post ) {
       $value = get_post_meta( $post->ID, '_banner_link', true );
       echo '<label for="_banner_link">' . __( 'Link do banner (opcional):', '_wp-manurios' ) . '</label> ';
       echo '<input type="url" id="_banner_link" name="_banner_link" value="' . esc_attr( $value ) . '" style="width:100%" placeholder="https://..." />';
}

function _wp_manurios_save_banner_meta( $post_id ) {
       if ( array_key_exists( '_banner_link', $_POST ) ) {
	       update_post_meta( $post_id, '_banner_link', esc_url_raw( $_POST['_banner_link'] ) );
       }
}
add_action( 'save_post_banner', '_wp_manurios_save_banner_meta' );
/**
 * Exibe o slider de banners na home
 */
function _wp_manurios_home_banner_slider() {
       if ( ! is_front_page() ) return;

       $args = array(
	       'post_type'      => 'banner',
	       'posts_per_page' => -1,
	       'post_status'    => 'publish',
	       'orderby'        => 'menu_order date',
	       'order'          => 'ASC',
       );
       $banners = get_posts( $args );
       if ( empty( $banners ) ) return;

	$has_multiple_slides = count( $banners ) > 1;

	?>
		<div class="wp-manurios-banner-slider">
			<div class="slider-track" style="will-change: transform;">
			       <?php foreach ( $banners as $i => $banner ) :
				       $img = get_the_post_thumbnail_url( $banner->ID, 'full' );
				       $text = apply_filters( 'the_content', $banner->post_content );
				       $link = get_post_meta( $banner->ID, '_banner_link', true );
			       ?>
				<div class="slide">
				       <?php if ( $img ) : ?>
					       <?php if ( $link ) : ?><a href="<?php echo esc_url( $link ); ?>"><?php endif; ?>
						<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title( $banner ) ); ?>" draggable="false" />
					       <?php if ( $link ) : ?></a><?php endif; ?>
				       <?php endif; ?>
				       <?php if ( $text ) : ?>
					       <div class="slide-caption">
						       <div class="slide-caption-inner">
							       <?php echo $text; ?>
						       </div>
					       </div>
				       <?php endif; ?>
			       </div>
			       <?php endforeach; ?>
		       </div>
			<?php if ( $has_multiple_slides ) : ?>
				<!-- Arrows -->
				<button class="slider-arrow slider-arrow-prev" data-dir="prev" aria-label="Anterior">
					<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
				</button>
				<button class="slider-arrow slider-arrow-next" data-dir="next" aria-label="Próximo">
					<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
				</button>
				<!-- Dots -->
				<div class="slider-dots">
					<?php foreach ( $banners as $i => $banner ) : ?>
						<button class="slider-dot <?php if ( 0 === $i ) echo 'is-active'; ?>" data-slide="<?php echo $i; ?>" aria-label="Ir para o banner <?php echo $i+1; ?>">
							<svg width="8" height="8" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="2" fill="none"/></svg>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	       <script>
	       (function(){
		       const slider = document.querySelector('.wp-manurios-banner-slider');
		       if (!slider) return;
		       const track = slider.querySelector('.slider-track');
		       const slides = slider.querySelectorAll('.slide');
		       const dots = slider.querySelectorAll('.slider-dot');
		       const arrows = slider.querySelectorAll('.slider-arrow');
		       const dotsWrap = slider.querySelector('.slider-dots');
		       if (slides.length <= 1) {
			       arrows.forEach((a) => (a.style.display = 'none'));
			       if (dotsWrap) dotsWrap.style.display = 'none';
			       if (track) {
				       track.style.transform = 'translateX(0px)';
				       track.style.cursor = 'default';
			       }
			       return;
		       }
		       let current = 0;
		       const supportsPointer = 'PointerEvent' in window;
		       let preventClickUntil = 0;
		       function markDragged() { preventClickUntil = Date.now() + 250; }
		       function offsetFor(index) {
			       const w = slider.clientWidth || slider.getBoundingClientRect().width;
			       return -(index * w);
		       }
		       function goTo(idx) {
			       current = idx;
			       if (current < 0) current = slides.length-1;
			       if (current >= slides.length) current = 0;
			       track.style.transform = `translateX(${offsetFor(current)}px)`;
			       dots.forEach((d,i)=>d.classList.toggle('is-active',i===current));
		       }
		       arrows.forEach(a=>a.addEventListener('click',e=>{
			       goTo(a.dataset.dir==='next'?current+1:current-1);
		       }));
		       dots.forEach((d,i)=>d.addEventListener('click',()=>goTo(i)));
		       // Drag / swipe support (mouse + touch)
		       let startX = null;
		       let dragging = false;
		       let moved = false;
		       function startDrag(x) {
			       startX = x;
			       dragging = true;
			       moved = false;
			       slider.classList.add('is-dragging');
		       }
		       function moveDrag(x) {
			       if (!dragging || startX === null) return;
			       const dx = x - startX;
			       if (Math.abs(dx) > 5) moved = true;
		       }
		       function endDrag(x) {
			       if (!dragging || startX === null) return;
			       const dx = x - startX;
			       if (Math.abs(dx) > 50) {
				       goTo(dx < 0 ? current + 1 : current - 1);
				       markDragged();
			       } else if (moved) {
				       markDragged();
			       }
			       startX = null;
			       dragging = false;
			       moved = false;
			       slider.classList.remove('is-dragging');
		       }
		       if (supportsPointer) {
			       track.addEventListener('pointerdown', (e) => {
				       if (e.pointerType === 'mouse' && e.button !== 0) return;
				       startDrag(e.clientX);
				       try { track.setPointerCapture(e.pointerId); } catch (_) {}
			       });
			       track.addEventListener('pointermove', (e) => moveDrag(e.clientX));
			       track.addEventListener('pointerup', (e) => endDrag(e.clientX));
			       track.addEventListener('pointercancel', (e) => endDrag(e.clientX));
		       } else {
			       track.addEventListener('touchstart', (e) => startDrag(e.touches[0].clientX), { passive: true });
			       track.addEventListener('touchmove', (e) => moveDrag(e.touches[0].clientX), { passive: true });
			       track.addEventListener('touchend', (e) => endDrag(e.changedTouches[0].clientX));
		       }
		       slider.addEventListener('click', (e) => {
			       if (Date.now() < preventClickUntil) {
				       e.preventDefault();
				       e.stopPropagation();
			       }
		       }, true);
		       window.addEventListener('resize',()=>goTo(current));
		       goTo(0);
	       })();
	       </script>
	       <style>
	       .hero-section { position: relative; overflow: hidden; padding: 0; margin: 0; height: 90vh; min-height: 600px; }
	       .wp-manurios-banner-slider { position: absolute; inset: 0; width: 100%; height: 100%; overflow: hidden; }
	       .wp-manurios-banner-slider .slider-track { display: flex; height: 100%; transition: transform 0.7s cubic-bezier(.4,0,.2,1); cursor: grab; touch-action: pan-y; }
	       .wp-manurios-banner-slider.is-dragging .slider-track { cursor: grabbing; }
	       .wp-manurios-banner-slider .slide { flex: 0 0 100%; width: 100%; height: 100%; position: relative; }
	       .wp-manurios-banner-slider .slide img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; user-select: none; -webkit-user-drag: none; }
	       .wp-manurios-banner-slider .slide-caption { position: absolute; left: 0; right: 0; bottom: 2.5rem; display: flex; justify-content: center; padding: 0 1rem; }
	       .wp-manurios-banner-slider .slide-caption-inner { background: rgba(0,0,0,0.6); color: #fff; padding: 0.75rem 1.25rem; border-radius: 0.5rem; max-width: 40rem; text-align: center; }
	       .wp-manurios-banner-slider .slider-arrow { position: absolute; top: 50%; transform: translateY(-50%); z-index: 30; background: rgba(0,0,0,0.4); color: #fff; border: 0; border-radius: 9999px; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; cursor: pointer; }
	       .wp-manurios-banner-slider .slider-arrow-prev { left: 0.5rem; }
	       .wp-manurios-banner-slider .slider-arrow-next { right: 0.5rem; }
	       .wp-manurios-banner-slider .slider-dots { position: absolute; bottom: 1rem; left: 0; right: 0; display: flex; justify-content: center; gap: 0.5rem; z-index: 30; }
	       .wp-manurios-banner-slider .slider-dot { width: 0.85rem; height: 0.85rem; border-radius: 9999px; background: rgba(255,255,255,0.6); border: 1px solid #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; padding: 0; }
	       .wp-manurios-banner-slider .slider-dot.is-active { background: rgba(255,255,255,0.95); }
	       @media (max-width: 768px) {
		       .wp-manurios-banner-slider .slide img { object-position: center center; }
	       }
	       </style>
	       <?php
}


/**
 * Customize Newsletter columns in admin
 */
function _wp_manurios_newsletter_columns( $columns ) {
	$new_columns = array(
		'cb'         => $columns['cb'],
		'title'      => __( 'Email', '_wp-manurios' ),
		'date'       => __( 'Subscribed Date', '_wp-manurios' ),
	);
	return $new_columns;
}
add_filter( 'manage_newsletter_posts_columns', '_wp_manurios_newsletter_columns' );

/**
 * AJAX handler for newsletter subscription
 */
function _wp_manurios_newsletter_subscribe() {
	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'newsletter_subscribe' ) ) {
		wp_send_json_error( array( 'message' => 'Erro de segurança. Por favor, recarregue a página.' ) );
	}

	// Validate email
	$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';

	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Por favor, insira um e-mail válido.' ) );
	}

	// Check if email already exists
	$existing = get_posts( array(
		'post_type'      => 'newsletter',
		'title'          => $email,
		'posts_per_page' => 1,
		'post_status'    => 'publish',
	) );

	if ( ! empty( $existing ) ) {
		wp_send_json_error( array( 'message' => 'Este e-mail já está cadastrado em nossa newsletter.' ) );
	}

	// Create new subscriber
	$post_id = wp_insert_post( array(
		'post_type'   => 'newsletter',
		'post_title'  => $email,
		'post_status' => 'publish',
	) );

	if ( is_wp_error( $post_id ) ) {
		wp_send_json_error( array( 'message' => 'Erro ao processar inscrição. Tente novamente.' ) );
	}

	wp_send_json_success( array( 'message' => 'Inscrição realizada com sucesso! Obrigado por se cadastrar.' ) );
}
add_action( 'wp_ajax_newsletter_subscribe', '_wp_manurios_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_newsletter_subscribe', '_wp_manurios_newsletter_subscribe' );

/**
 * Modify menu items to link to home sections when on front page
 */
function _wp_manurios_nav_menu_items( $items, $args ) {
	// Only modify the primary menu on the front page
	if ( ! is_front_page() ) {
		return $items;
	}

	// Check if this is the primary menu
	$is_primary_menu = false;
	if ( is_object( $args ) && isset( $args->theme_location ) && 'menu-1' === $args->theme_location ) {
		$is_primary_menu = true;
	} elseif ( is_array( $args ) && isset( $args['theme_location'] ) && 'menu-1' === $args['theme_location'] ) {
		$is_primary_menu = true;
	}

	if ( ! $is_primary_menu ) {
		return $items;
	}

	// Map menu item titles to section IDs
	$section_map = array(
		'sobre'            => '#about',
		'about'            => '#about',
		'palestras'        => '#palestras',
		'serviços'         => '#features',
		'servicos'         => '#features',
		'produtos'         => '#features',
		'features'         => '#features',
		'serviços & produtos' => '#features',
		'servicos & produtos' => '#features',
		'blog'             => '#blog',
		'na mídia'         => '#blog',
		'na midia'         => '#blog',
		'mídia'            => '#blog',
		'midia'            => '#blog',
		'contato'          => '#contact',
		'contact'          => '#contact',
	);

	foreach ( $items as $item ) {
		// Get the menu item title in lowercase for comparison
		$title_lower = strtolower( trim( $item->title ) );
		
		// Check if this menu item should link to a section
		foreach ( $section_map as $key => $section_id ) {
			if ( false !== strpos( $title_lower, $key ) ) {
				// Modify the URL to point to the section anchor
				$item->url = home_url( '/' ) . $section_id;
				break;
			}
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', '_wp_manurios_nav_menu_items', 10, 2 );

/**
 * Enqueue newsletter script
 */
function _wp_manurios_newsletter_script() {
	if ( is_front_page() ) {
		wp_localize_script( '_wp-manurios-script', 'newsletterData', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'newsletter_subscribe' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', '_wp_manurios_newsletter_script' );

/**
 * Disable WordPress Service Workers
 */
function _wp_manurios_disable_service_workers() {
	// Remove service worker scripts
	remove_action( 'wp_head', 'wp_service_worker_meta', 1 );
	remove_action( 'wp_front_service_worker', 'wp_default_service_worker' );
}
add_action( 'init', '_wp_manurios_disable_service_workers', 1 );

/**
 * Fetch latest episodes from a Spotify Show URL without requiring API keys.
 *
 * Strategy:
 * - Fetch show page HTML and extract episode URLs
 * - For each episode, use Spotify oEmbed to get title + thumbnail
 * - Cache results with transients to avoid frequent requests
 */
function _wp_manurios_get_spotify_latest_episodes( $spotify_url, $limit = 5 ) {
	$spotify_url = trim( (string) $spotify_url );
	$limit       = max( 1, (int) $limit );

	if ( $spotify_url === '' ) {
		return array();
	}

	// Normalize embed URLs back to canonical spotify.com URLs.
	$spotify_show_url = preg_replace( '~^https?://open\.spotify\.com/embed/~', 'https://open.spotify.com/', $spotify_url, 1 );

	if ( ! preg_match( '~^https?://open\.spotify\.com/show/([A-Za-z0-9]+)~', $spotify_show_url, $m ) ) {
		return array();
	}

	$show_id   = (string) $m[1];
	// Versioned cache key to force refresh when logic changes
	$cache_key = '_wp_mnr_sp_show_v2_' . $show_id;
	$cached    = get_transient( $cache_key );
	if ( is_array( $cached ) && ! empty( $cached ) ) {
		return array_slice( $cached, 0, $limit );
	}

	$response = wp_remote_get(
		$spotify_show_url,
		array(
			'timeout'     => 8,
			'redirection' => 3,
			'headers'     => array(
				'User-Agent' => 'Mozilla/5.0 (WordPress; _wp-manurios)',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return array();
	}

	$body = (string) wp_remote_retrieve_body( $response );
	if ( $body === '' ) {
		return array();
	}

	// Spotify show pages commonly use relative episode links like "/episode/{id}".
	preg_match_all( '~/(?:intl-[a-z]{2}/)?episode/([A-Za-z0-9]+)~', $body, $matches );
	$episode_ids = isset( $matches[1] ) ? array_values( array_unique( $matches[1] ) ) : array();
	$episode_ids = array_slice( $episode_ids, 0, $limit );

	// Fetch Show metadata (thumbnail) to use as fallback
	$show_thumb_url = '';
	$show_oembed_key = '_wp_mnr_sp_show_oembed_' . $show_id;
	$show_oembed     = get_transient( $show_oembed_key );

	if ( ! is_array( $show_oembed ) ) {
		$show_oembed_response = wp_remote_get(
			'https://open.spotify.com/oembed?url=' . rawurlencode( $spotify_show_url ),
			array(
				'timeout'     => 8,
				'redirection' => 3,
				'headers'     => array(
					'User-Agent' => 'Mozilla/5.0 (WordPress; _wp-manurios)',
				),
			)
		);

		if ( ! is_wp_error( $show_oembed_response ) ) {
			$json = json_decode( (string) wp_remote_retrieve_body( $show_oembed_response ), true );
			if ( is_array( $json ) ) {
				$show_oembed = $json;
				set_transient( $show_oembed_key, $show_oembed, 24 * HOUR_IN_SECONDS );
			}
		}
	}

	if ( is_array( $show_oembed ) && isset( $show_oembed['thumbnail_url'] ) ) {
		$show_thumb_url = (string) $show_oembed['thumbnail_url'];
	}

	$episode_urls = array();
	foreach ( $episode_ids as $episode_id ) {
		$episode_urls[] = 'https://open.spotify.com/episode/' . $episode_id;
	}

	$episodes = array();
	foreach ( $episode_urls as $episode_url ) {
		$episode_url = trim( (string) $episode_url );
		if ( $episode_url === '' ) {
			continue;
		}

		$oembed_key = '_wp_mnr_sp_ep_' . md5( $episode_url );
		$oembed     = get_transient( $oembed_key );

		if ( ! is_array( $oembed ) ) {
			$oembed_response = wp_remote_get(
				'https://open.spotify.com/oembed?url=' . rawurlencode( $episode_url ),
				array(
					'timeout'     => 8,
					'redirection' => 3,
					'headers'     => array(
						'User-Agent' => 'Mozilla/5.0 (WordPress; _wp-manurios)',
					),
				)
			);

			if ( ! is_wp_error( $oembed_response ) ) {
				$json = json_decode( (string) wp_remote_retrieve_body( $oembed_response ), true );
				if ( is_array( $json ) ) {
					$oembed = $json;
					set_transient( $oembed_key, $oembed, 12 * HOUR_IN_SECONDS );
				}
			}
		}

		if ( is_array( $oembed ) ) {
			$title     = isset( $oembed['title'] ) ? (string) $oembed['title'] : '';
			$thumb_url = isset( $oembed['thumbnail_url'] ) ? (string) $oembed['thumbnail_url'] : '';
			
			// Fallback to show thumbnail
			if ( empty( $thumb_url ) ) {
				$thumb_url = $show_thumb_url;
			}

			if ( $title !== '' ) {
				$episodes[] = array(
					'title'     => $title,
					'url'       => $episode_url,
					'thumb_url' => $thumb_url,
				);
			}
		}
	}

	if ( ! empty( $episodes ) ) {
		set_transient( $cache_key, $episodes, 6 * HOUR_IN_SECONDS );
	}

	return $episodes;
}

/**
 * Hide admin bar on front-end
 */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Post Type: Mídias Digitais
 */
require get_template_directory() . '/inc/cpt-midias-digitais.php';
