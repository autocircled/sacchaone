<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
			<?php
			if ( have_posts() ) {
				?>
				<div id="primary" class="content-area <?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?>">
					<h1 class="page-title mb-5">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'sacchaone' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
					<section class="search-results">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						if ( function_exists( 'sacchaone_the_posts_pagination' ) ) :
							sacchaone_the_posts_pagination();
						endif;
						?>
					</section>
				</div><!-- #primary -->

				<?php
				if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'both-sidebar' ) {
					get_sidebar( 'left' );
				}

				if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) !== 'no-sidebar' ) {
					get_sidebar();
				}
			} else {

				get_template_part( 'template-parts/content', 'none' );

			}
			?>
		</div><!-- .row -->
	</main><!-- #main -->

<?php
get_footer();
