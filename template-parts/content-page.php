<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sone-article-single' ); ?>>
	<?php
	if ( has_post_thumbnail() ) :
		?>
		<div class="caption">
			<?php sacchaone_post_thumbnail(); ?>
		</div>
		<?php
	endif;
	?>
	<div class="content-wrapper">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sacchaone' ),
					'after'  => '</div>',
				)
			);

			?>
		</div><!-- .entry-content -->

		<?php
		if ( get_edit_post_link() ) :
			?>
			<footer class="entry-footer">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'sacchaone' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer><!-- .entry-footer -->
			<?php
		endif;
		?>
	</div>
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
