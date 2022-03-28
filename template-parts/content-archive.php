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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sone-article-archive' ); ?>>
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
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					sacchaone_posted_on();
					sacchaone_posted_by();
					?>
				</div><!-- .entry-meta -->
				<?php
			endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php sacchaone_excerpt(); ?>
		</div><!-- .entry-content -->

	</div><!-- .entry-content-wrapper -->
</article>


