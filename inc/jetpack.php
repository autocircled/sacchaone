<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function sacchaone_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'primary',
			'render'    => 'sacchaone_infinite_scroll_render',
			'footer'    => false,
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details'    => array(
				'stylesheet' => 'sacchaone-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'sacchaone_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function sacchaone_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}

/**
 * Change infinite scroll.
 */
function sacchaone_custom_infinite_more() {
	if ( is_home() || is_archive() || is_search() ) {
		?>
		<script type="text/javascript">
		//<![CDATA[
		infiniteScroll.settings.text = "<?php echo esc_html( sacchaone_get_defaults( 'sacchaone_load_more_text' ) ); ?>";
		//]]>
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'sacchaone_custom_infinite_more', 3 );
