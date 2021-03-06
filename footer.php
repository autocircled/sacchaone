<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Hook - sacchaone_footer
 *
 * @hooked sacchaone_footer - 10
 */
do_action( 'sacchaone_footer' );
?>
<div id="scroll_to_top" class="scroll-to-top"><i class="fa fa-angle-up"></i></div>
<?php wp_footer(); ?>

</body>
</html>
