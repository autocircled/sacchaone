<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

	<main id="site-content" class="site-main container mt-5">
		<div class="row">
			<div id="primary" class="content-area <?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?>">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</div><!-- .<?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?> -->

			<?php
			if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'both-sidebar' ) {
				get_sidebar( 'left' );
			}

			if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) !== 'no-sidebar' ) {
				get_sidebar();
			}
			?>

		</div><!-- .row -->

	</main><!-- #main -->

<?php
get_footer();
