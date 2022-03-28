<?php
/**
 * Template part for displaying modal menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SacchaOne
 */

?>
<div class="saccha-sm-menu-modal modal fade" id="site-navigation-mobile" tabindex="-1" aria-hidden="true">
	<div class="saccha-sm-menu-inner modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-outline-primary saccha-btn-close" data-dismiss="modal" aria-label="Close">
					<span class="fa fa-close"></span>
				</button>
			</div>
			<div class="modal-body">
			<?php
			if ( has_nav_menu( 'primary' ) ) :
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'depth'           => 4,
						'container'       => 'div',
						'container_class' => 'main-navigation mobile',
						// 'container_id'    => 'navbar-collapse',
						'menu_class'      => 'nav nav-menu',
						'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
						'walker'          => new SacchaOne_Walker_Menu(),
					)
				);
			else :
				wp_page_menu(
					array(
						'container'  => 'div',
						// 'menu_id' => 'main-navigation',
						'menu_class' => 'main-navigation mobile',
						'before'     => '<ul class="nav nav-menu">',
						'walker'          => new SacchaOne_Walker_Page(),
					)
				);
			endif;
			?>
			</div>
		</div>
	</div>
</div>
