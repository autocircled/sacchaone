<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$defaults = sacchaone_get_defaults();
?>

	<main id="site-content" class="site-main container mt-5">
		<div class="row">
			<?php
			if ( sacchaone_sidebar( 'left' ) ) {
				get_sidebar( 'left' );
			}
			?>
			<div id="primary" class="content-area <?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?>">
				<section class="error-404 not-found content-wrapper">
					<header class="entry-header">
						<h1 class="error-message"><?php echo esc_html( $defaults['sacchaone_404_title'] ); ?></h1>
						<h3 class="page-title"><?php echo esc_html( $defaults['sacchaone_404_subtitle'] ); ?></h3>
					</header><!-- .entry-header -->

					<div class="entry-content clearfix">
						<p><?php echo esc_html( $defaults['sacchaone_404_desc'] ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div><!-- .<?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?> -->
			<?php
			if ( sacchaone_sidebar( 'right' ) ) {
				get_sidebar();
			}
			?>
		</div>
	</main><!-- #main -->
<?php
get_footer();
