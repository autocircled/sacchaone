<?php
/**
 * Template part for displaying posts
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
	if ( 'post' === get_post_type() ) :
		if ( has_post_thumbnail() ) :
			?>
			<div class="caption">
				<?php sacchaone_post_thumbnail( 'sacchaone-blog-thumbnail' ); ?>
			</div>
			<?php
		endif;
	endif;
	?>

	<div class="content-wrapper">
		<header class="entry-header">

			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
				<div class="blog_post_meta">
					<?php
					sacchaone_posted_on();
					sacchaone_posted_by();
					?>
				</div>
				<?php
			else :
				?>

				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php
						the_title();
						?>
					</a>
				</h2>
				<?php
			endif;
			?>
			<div class="taxonomy-meta">
				<?php sacchaone_entry_footer(); ?>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
		<?php
		if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sacchaone' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="sone-page-links">' . esc_html__( 'Pages:', 'sacchaone' ),
					'after'  => '</div>',
				)
			);
		else :
			sacchaone_excerpt();
		endif;

		?>
		</div><!-- .entry-content -->
	</div><!-- .content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
