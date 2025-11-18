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
	wp_enqueue_style( '_wp-manurios-style', get_stylesheet_uri(), array(), _WP_MANURIOS_VERSION );
	
	// Compiled SCSS styles (loaded after Tailwind to override)
	wp_enqueue_style( '_wp-manurios-scss', get_template_directory_uri() . '/css/main.css', array( '_wp-manurios-style' ), _WP_MANURIOS_VERSION . '-scss' );
	
	wp_enqueue_script( '_wp-manurios-script', get_template_directory_uri() . '/js/script.min.js', array(), _WP_MANURIOS_VERSION, true );

	// Alpine.js for interactive components
	wp_enqueue_script( 'alpinejs', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), '3.x.x', true );
	wp_script_add_data( 'alpinejs', 'defer', true );

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

	// Logo Section (using WordPress default custom-logo support)
	// The logo option will appear in "Site Identity" section automatically
}
add_action( 'customize_register', '_wp_manurios_customize_register' );

/**
 * Register Newsletter Custom Post Type
 */
function _wp_manurios_register_newsletter_cpt() {
	$labels = array(
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

	$args = array(
		'labels'             => $labels,
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

	register_post_type( 'newsletter', $args );
}
add_action( 'init', '_wp_manurios_register_newsletter_cpt' );

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
		'contato'          => '#contact',
		'contact'          => '#contact',
		'newsletter'       => '#newsletter',
		'receba novidades' => '#newsletter',
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
