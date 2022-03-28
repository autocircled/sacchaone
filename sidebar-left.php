<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="secondary-2" class="sidebar sidebar-secondary-2 text-left <?php echo esc_attr( sacchaone_class_attr( 'sidebar' ) ); ?>">
	<div class="blog-sidebar">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>
</aside><!-- #secondary -->
