<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row sone-article-search' ); ?>>
	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', esc_attr( _x( 'Featured', 'post', 'sacchaone' ) ) );
	}

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

	<div class="search content-wrapper">
		<header class="entry-header">
			<?php
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					sacchaone_posted_on();
					sacchaone_posted_by();
					?>
				</div><!-- .entry-meta -->
				<div class="taxonomy-meta">
					<?php sacchaone_entry_footer(); ?>
				</div>
					<?php
				endif;
			?>
		</header>

		<div class="search-content clearfix">
			<?php sacchaone_excerpt(); ?>
		</div>
	</div><!-- .search.entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
