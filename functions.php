<?php
/**
 * starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package starter
 */

if ( ! defined( 'STARTER_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'STARTER_VERSION', '1.0.0' );
}

if ( ! function_exists( 'starter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function starter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on starter, use a find and replace
		 * to change 'starter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'starter', get_template_directory() . '/languages' );

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
		add_image_size( 'starter-slide-image', 1024, 600, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'starter' ),
		) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'footer_menu' => esc_html__( 'Footer Menu', 'starter' ),
		) );

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

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'starter_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		remove_theme_support( 'widgets-block-editor' );
		
	}
endif;
add_action( 'after_setup_theme', 'starter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'starter_content_width', 0 );

if ( ! function_exists( 'starter_fonts_url' ) ) :
	/**
	 * Register Google fonts.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	
	function starter_fonts_url() {
		$font_url = '';
		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Open Sans, translate this to 'off'. Do not translate into your own language.
		 */
		
		$primary_font = get_theme_mod( 'primary_font' ) ? get_theme_mod( 'primary_font' ) : 'Source+Sans+Pro:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600&display=swap';
		$secondary_font = get_theme_mod( 'secondary_font' ) ? get_theme_mod( 'secondary_font' ) : 'Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap';
	
		if ( 'off' !== _x( 'on', 'Fonts: on or off', 'starter' ) ) {
			$query_args = array(
				'family' => $primary_font,
				//'family' => $primary_font.'&family='. $secondary_font
			);
			$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
		}
		return $font_url;
	}
endif;
	
// Menu fallback
function starter_primary_menu_fallback(){
	echo '<ul class="navbar-nav ml-auto main-menu-nav"><li><a href="'.esc_url( admin_url( 'nav-menus.php' ) ).'"></a></li></ul>';
}

/**
 * Enqueue scripts and styles.
 */
function starter_scripts() {

	// Bootstrap 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css' );

	// Icon Fonts
	wp_enqueue_style( 'line-awesome', get_template_directory_uri() . '/fonts/line-awesome/css/line-awesome.min.css' );

	// Theme Google fonts
	if( get_theme_mod( 'display_font' ) == 2 ):
		wp_enqueue_style( 'startert-fonts', starter_fonts_url(), array(), null );
	endif;
	
	// Main & RTL Stylesheet
	wp_enqueue_style( 'starter-style', get_stylesheet_uri(), array(), STARTER_VERSION );
	wp_style_add_data( 'starter-style', 'rtl', 'replace' );

	// Responsive file
	wp_enqueue_style( 'starter-responsive', get_template_directory_uri() . '/css/responsive.css' );


	// Bootstrap Script
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), false, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Adding Dashicons in WordPress Front-end
	wp_enqueue_style( 'dashicons' );


	// Smooth Scrool Script
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), false, true );

	// Starter custom js
	wp_enqueue_script( 'starter-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery', 'masonry' ), false, true );

}
add_action( 'wp_enqueue_scripts', 'starter_scripts' );

// Admin scripts
function starter_admin_scripts( $screen ) {		
	// Widget js
	if( 'widgets.php' == $screen ){
		wp_enqueue_script( 'welearner-script', get_template_directory_uri() . '/js/admin/widget.js', array( 'jquery' ), false, true );
	}
}
add_action( 'admin_enqueue_scripts', 'starter_admin_scripts' );

// WordPress Default login scripts
function starter_login_stylesheet() {
    wp_enqueue_style( 'starter-login', get_stylesheet_directory_uri() . '/css/admin/login.css' );
}
add_action( 'login_enqueue_scripts', 'starter_login_stylesheet' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widget additions.
 */
require get_template_directory() . '/inc/widget.php';

/**
 * Breadcrumbs additions.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

 /**
 * Add Plugins
 */
require get_template_directory() . '/inc/plugins.php';

/**
 * Botstrap nav additions.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

