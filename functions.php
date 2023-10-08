<?php
/**
 * SacchaOne functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
if ( ! defined( '_SACCHAONE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_SACCHAONE_VERSION', '1.0.8' );
}

if ( ! defined( 'SACCHAONE_THEME_SETTINGS' ) ) {
	define( 'SACCHAONE_THEME_SETTINGS', 'theme_mods_sacchaone' );
}

if ( ! defined( 'SACCHAONE_THEME_DIR' ) ) {
	define( 'SACCHAONE_THEME_DIR', trailingslashit( get_stylesheet_directory_uri() ) );
}

if ( ! defined( 'SACCHAONE_PREFIX' ) ) {
	define( 'SACCHAONE_PREFIX', '_sacchaone_' );
}



if ( ! function_exists( 'sacchaone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sacchaone_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'sacchaone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'sacchaone' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'sacchaone_custom_background_args',
				array(
					'default-color' => 'f0f0f1',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Enable responsive embed support.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
		 */
		add_theme_support( 'responsive-embeds' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 70,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'sacchaone_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sacchaone_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sacchaone_content_width', 1200 );
}
add_action( 'after_setup_theme', 'sacchaone_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since 0.6
 */
function sacchaone_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), _SACCHAONE_VERSION, 'all' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), _SACCHAONE_VERSION, 'all' );

	wp_enqueue_style( 'sacchaone-style', get_stylesheet_uri(), array(), _SACCHAONE_VERSION );

	wp_enqueue_style( 'sacchaone-main-style', get_template_directory_uri() . '/assets/css/sacchaone-style.css', array(), _SACCHAONE_VERSION, 'all' );

	// wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'sacchaone-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _SACCHAONE_VERSION, true );

	// wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), _SACCHAONE_VERSION, true );

	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/assets/js/lazy-load-images.min.js', array(), _SACCHAONE_VERSION, true );

	wp_enqueue_script( 'sacchaone-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), _SACCHAONE_VERSION, true );

	$saccha_data = array(
		'scroll_spy_selector' => apply_filters( 'saccha_scroll_spy_selector', 'afb-item-title' ),
	);

	wp_localize_script( 'sacchaone-custom', 'SACCHA_DATA', $saccha_data );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sacchaone_scripts' );

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/hooked-functions.php';

require get_template_directory() . '/inc/archives.php';

// Custom menu walker.
require get_template_directory() . '/inc/class-sacchaone-walker-page.php';
require get_template_directory() . '/inc/class-sacchaone-walker-menu.php';

// Framework
if ( is_admin() ) {
	require get_template_directory() . '/inc/framework/class-sacchaone-framework.php';
}
// Metabox
require get_template_directory() . '/inc/class-sacchaone-metabox.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/class-sacchaone-css.php';
require get_template_directory() . '/inc/dynamic-css.php';
require get_template_directory() . '/inc/class-sacchaone-range-control.php';
require get_template_directory() . '/inc/class-sacchaone-separator-control.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
