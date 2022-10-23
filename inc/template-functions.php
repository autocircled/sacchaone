<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sacchaone_body_classes( $classes ) {

	// Get default settings values
	$defaults = sacchaone_get_defaults();

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Add class based on customizer settings.
	if ( get_theme_mod( 'sacchaone_header_preset' ) ) {
		$settings = get_theme_mod( 'sacchaone_header_preset' );
		switch ( $settings ) {
			case 'top':
				$classes[] = 'sone-nav-top';
				break;
			case 'top_center':
				$classes[] = 'sone-nav-top-center';
				break;
			case 'bottom':
				$classes[] = 'sone-nav-bottom';
				break;
			case 'bottom_center':
				$classes[] = 'sone-nav-bottom-center';
				break;
			case 'left':
				$classes[] = 'sone-nav-left';
				break;
			default:
				$classes[] = 'sone-nav-default';
				break;
		}
	}

	// Customizer settings
	$classes[] = get_theme_mod( 'sacchaone_sidebar_type', sacchaone_get_defaults( 'sacchaone_sidebar_type' ) );
	$classes[] = get_theme_mod( 'sacchaone_sticky_nav', sacchaone_get_defaults( 'sacchaone_sticky_nav' ) ) === 'enable' ? 'sticky-nav-enabled' : 'sticky-nav-disabled';

	// Add class for back2top button.
	$back2top_status = get_theme_mod( 'sacchaone_back2top', 1 );

	if ( $back2top_status ) {
		$classes[] = 'back2top-enabled';
	} else {
		$classes[] = 'back2top-disabled';
	}

	$classes[] = 'back2top-' . get_theme_mod( 'sacchaone_back2top_position', $defaults['sacchaone_back2top_position'] );

	// Individual post/page settings
	$additional_settings = get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'additional_settings', true );
	if ( 'yes' === $additional_settings ) {

		$transparent_header = get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'transparent_page_header', true );
		if ( 'yes' === $transparent_header ) {
			$classes[] = 'transparent-header';
		}

		// Sidebar left, right, both or none.
		$sidebar_type = get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true );
		$classes[] = 'sidebar_' . $sidebar_type;

	}

	// Add class based on customizer settings.
	if ( get_theme_mod( 'sacchaone_sidebar_settings' ) ) {

		// If there is no active sidebar ther we won't go further.
		if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
			return $classes;
		}

		// Removing array key 'no-sidebar'.
		$key = array_search( 'no-sidebar', $classes, true );
		if ( false !== $key ) {
			unset( $classes[ $key ] );
		}

		$sidebar = get_theme_mod( 'sacchaone_sidebar_settings', 'default' );
		if ( 'both-sidebar' === $sidebar ) {
			$classes[] = 'sone-both-sidebar';
		} elseif ( 'left-sidebar' === $sidebar ) {
			$classes[] = 'sone-left-sidebar';
		} elseif ( 'right-sidebar' === $sidebar ) {
			$classes[] = 'sone-right-sidebar';
		} elseif ( 'no-sidebar' === $sidebar ) {
			$classes[] = 'no-sidebar';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'sacchaone_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sacchaone_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'sacchaone_pingback_header' );


/**
 * Add Image Size
 *
 * @since 0.1
 */
function sacchaone_thumbsize() {
	add_image_size( 'sacchaone-sidebar-thumbnail', 100, 100, true );
	add_image_size( 'sacchaone-home-thumbnail', 370, 320, true );
	add_image_size( 'sacchaone-blog-thumbnail', 1200, 628, true );
}
add_action( 'after_setup_theme', 'sacchaone_thumbsize' );

/**
 * Custom Excerpt
 *
 * @param int $count The number of letter to print.
 * @since 0.1
 */
function sacchaone_excerpt( $count = 55 ) {
	global $post;
	$excerpt_type = get_theme_mod( 'sacchaone_blog_settings' );
	if ( 'full-content' === $excerpt_type ) {
		echo wp_kses_post( get_the_content() );
	} else {
		$readmore = ' ... ' . sprintf( '<a href="' . get_the_permalink( $post->ID ) . '">%s</a>', __( 'Read More', 'sacchaone' ) );
		$excerpt  = wp_trim_words( get_the_excerpt(), $count, $readmore );
		echo wp_kses_post( $excerpt );
	}
}

if ( ! function_exists( 'sacchaone_the_posts_pagination' ) ) {
	/**
	 * Pagination
	 *
	 * @since 0.1
	 */
	function sacchaone_the_posts_pagination() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( 'Prev', 'sacchaone' ),
				'next_text' => __( 'Next', 'sacchaone' ),
			)
		);
	}
}

if ( ! function_exists( 'sacchaone_site_logo' ) ) {
	/**
	 * Show site logo or text
	 *
	 * @param array $args   See $defaults array.
	 * @param bool  $echo   Should return or echo.
	 *
	 * @since 0.1
	 */
	function sacchaone_site_logo( $args = array(), $echo = true ) {
		$logo       = get_custom_logo();
		$site_title = get_bloginfo( 'name' );
		$contents   = '';
		$classname  = '';

		$defaults = array(
			'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
			'logo_class'  => 'site-logo',
			'title'       => '<a href="%1$s">%2$s</a>',
			'title_class' => 'site-title',
			'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
			'single_wrap' => '<p class="%1$s">%2$s</p>',
			'condition'   => ( is_front_page() || is_home() ) && ! is_page(),
		);

		$args = wp_parse_args( $args, $defaults );

		/**
		 * Filters the arguments for `sacchaone_site_logo_args`.
		 *
		 * @param array  $args     Parsed arguments.
		 * @param array  $defaults Function's default arguments.
		 *
		 * @since 0.1
		 */
		$args = apply_filters( 'sacchaone_site_logo_args', $args, $defaults );

		if ( has_custom_logo() ) {
			$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
			$classname = $args['logo_class'];
		} else {
			$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
			$classname = $args['title_class'];
		}

		$wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

		$html = sprintf( $args[ $wrap ], $classname, $contents );

		/**
		 * Filters the arguments for `sacchaone_site_logo`.
		 *
		 * @param string $html      Compiled html based on our arguments.
		 * @param array  $args      Parsed arguments.
		 * @param string $classname Class name based on current view, home or single.
		 * @param string $contents  HTML for site title or logo.
		 *
		 * @since 0.1
		 */
		$html = apply_filters( 'sacchaone_site_logo', $html, $args, $classname, $contents );

		if ( ! $echo ) {
			return $html;
		}

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

if ( ! function_exists( 'sacchaone_site_description' ) ) {
	/**
	 * Displays the site description.
	 *
	 * @param boolean $echo should return or echo.
	 *
	 * @return string $html The HTML to display.
	 *
	 * @since 0.1
	 */
	function sacchaone_site_description( $echo = true ) {

		$description = get_bloginfo( 'description' );

		if ( ! $description ) {
			return;
		}

		$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';

		$html = sprintf( $wrapper, esc_html( $description ) );

		/**
		 * Filters the html for the site description.
		 *
		 * @param string $html         The HTML to display.
		 * @param string $description  Site description via `bloginfo()`.
		 * @param string $wrapper      The format used in case you want to reuse it in a `sprintf()`.
		 *
		 * @since 0.1
		 */
		$html = apply_filters( 'sacchaone_site_description', $html, $description, $wrapper );

		if ( ! $echo ) {
			return $html;
		}

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'sacchaone_widgets_init' ) ) {

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function sacchaone_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'sacchaone' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Secondary Sidebar', 'sacchaone' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'sacchaone' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'sacchaone' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'sacchaone' ),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 4', 'sacchaone' ),
				'id'            => 'footer-4',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 5', 'sacchaone' ),
				'id'            => 'footer-5',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Copyright', 'sacchaone' ),
				'id'            => 'copyright',
				'description'   => esc_html__( 'Add widgets here.', 'sacchaone' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'sacchaone_widgets_init' );

if ( ! function_exists( 'sacchaone_skip_link_focus_fix' ) ) {
	/**
	 * Fix skip link focus in IE11.
	 *
	 * This does not enqueue the script because it is tiny and because it is only for IE11,
	 * thus it does not warrant having an entire dedicated blocking script being loaded.
	 *
	 * @link https://git.io/vWdr2
	 */
	function sacchaone_skip_link_focus_fix() {
		// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window
			.addEventListener("hashchange", function() {
				var t, e = location.hash.substring(1);
				/^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i
					.test(t.tagName) || (t.tabIndex = -1), t.focus())
			}, !1);
		</script>
		<?php
	}
}
add_action( 'wp_print_footer_scripts', 'sacchaone_skip_link_focus_fix' );

/**
 * Incluede skip link to top of the body
 */
function sacchaone_skip_link() {
	echo wp_kses_post( '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'sacchaone' ) . '</a>' );
}

add_action( 'wp_body_open', 'sacchaone_skip_link', 5 );

if ( ! function_exists( 'sacchaone_class_attr' ) ) {
	/**
	 * SacchaOne class attribute.
	 *
	 * @param string $location Class attribute location.
	 */
	function sacchaone_class_attr( $location ) {

		$sidebar_all = get_theme_mod( 'sacchaone_sidebar_settings', 'default' );
		$sidebar_single = get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true );
		$individual_settings = get_post_meta( get_the_ID(), SACCHAONE_PREFIX. 'additional_settings', true );
		$class = '';

		switch ( $location ) {
			case 'content-area':
				if ( 'yes' === $individual_settings ) {               // Individual Settings
					if ( 'left' === $sidebar_single || 'right' === $sidebar_single ) {
						$class = 'col-lg-8';
					} elseif ( 'both' === $sidebar_single ) {
						$class = 'col-lg-6';
					} elseif ( 'none' === $sidebar_single ) {
						$class = 'col-lg-12';
					}

				} else {                                              // Customizer settings
					if ( 'both-sidebar' === $sidebar_all ) {
						$class = 'col-lg-6';
					} elseif ( 'no-sidebar' === $sidebar_all ) {
						$class = '';
					} else {
						$class = 'col-lg-8';
					}
				}
				break;

			case 'sidebar':
				if ( 'yes' === $individual_settings ) {               // Individual Settings
					if ( 'left' === $sidebar_single || 'right' === $sidebar_single ) {
						$class = 'col-lg-4';
					} elseif ( 'both' === $sidebar_single ) {
						$class = 'col-lg-3';
					}
				} else {                                              // Customizer settings
					if ( 'both-sidebar' === $sidebar_all ) {
						$class = 'col-lg-3';
					} elseif ( 'no-sidebar' === $sidebar_all ) {
						$class = '';
					} else {
						$class = 'col-lg-4';
					}
				}
				break;
		}

		return apply_filters( 'sacchaone_main_column_classes', $class, $location );
	}
}

/**
 * Sanitize customizer select.
 *
 * @param string $input Input must be a slug.
 * @param object $setting Customizer settings.
 */
function sacchaone_sanitize_select( $input, $setting ) {

	// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only.
	$input = sanitize_key( $input );
	// get the list of possible select options.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if valid or return default option.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize customizer checkbox
 *
 * @param array $input Checkbox input.
 */
function sacchaone_sanitize_checkbox( $input ) {
	// returns true if checkbox is checked.
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
 * Sanitize customizer colors as RGBA.
 *
 * @param string $color Input must be a color.
 * @param object $setting Customizer settings.
 */
function sacchaone_sanitize_rgba( $color, $setting ) {
	var_dump($color, $setting );
	if ( empty( $color ) || is_array( $color ) )
		return 'rgba(0,0,0,0)';

	// If string does not start with 'rgba', then treat as hex
	// sanitize the hex color and finally convert hex to rgba
	if ( false === strpos( $color, 'rgba' ) ) {
		return sanitize_hex_color( $color );
	}

	// By now we know the string is formatted as an rgba color so we need to further sanitize it.
	$color = str_replace( ' ', '', $color );
	sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
	return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}


/**
 * Current page has children
 *
 * @since 1.0.0
 */
function sacchaone_page_has_children( $page_id ) {
	$pages = get_pages( 'child_of=' . $page_id );
	if ( count( $pages ) > 0 ):
		return true;
	else:
		return false;
	endif;
}

function sacchaone_sidebar( $position = 'right' ) {
	$individual_settings = get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'additional_settings', true );

	if ( 'left' === $position ) {
		if ( 'yes' === $individual_settings && ( get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true ) === 'both' || get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true ) === 'left' ) ) {
			return true;
		} elseif ( 'yes' === $individual_settings && get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true === 'none' ) ) {
			return false;
		}
		if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'both-sidebar' || get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'left-sidebar' ) {
			return true;
		}
	}

	if ( 'right' === $position ) {
		if ( 'yes' === $individual_settings && ( get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true ) === 'both' || get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true ) === 'right' ) ) {
			return true;
		} elseif ( 'yes' === $individual_settings && get_post_meta( get_the_ID(), SACCHAONE_PREFIX . 'sidebar_type', true === 'none' ) ) {
			return false;
		}

		if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'both-sidebar' || get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'right-sidebar' || get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'default' ) {
			return true;
		}
	}

	return false;
}
