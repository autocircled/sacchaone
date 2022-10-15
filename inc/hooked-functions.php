<?php
/**
 * Hooked functions
 *
 * All functions from here are hooked into the theme.
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'sacchaone_header' ) ) :
	/**
	 * SacchaOne header will be display.
	 *
	 * @since 1.0.0
	 */
	function sacchaone_header() {
		$header_width = get_theme_mod( 'sacchaone_header_width', 'full' );
		?>
		<header class="nav-header <?php echo 'full' === $header_width ? esc_attr( 'header-bg' ) : ''; ?>">
			<div class="header-inner container">
				<!--Navbar -->
				<nav id="site-navigation" class="navbar <?php echo 'box' === $header_width ? esc_attr( 'header-bg' ) : ''; ?>">
					<div class="site-info">
						<?php sacchaone_site_logo(); ?>
						<?php sacchaone_site_description(); ?>
					</div>
					<?php do_action( 'saccha_nav_center' ); ?>
					<div class="nav-wrapper">
						<?php
						if ( has_nav_menu( 'primary' ) ) :
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'depth'           => 4,
									'container'       => 'div',
									'container_class' => 'main-navigation desktop',
									// 'container_id'    => 'main-navigation',
									'menu_class'      => 'nav nav-menu',
									'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
									'walker'          => new SacchaOne_Walker_Menu(),
								)
							);
						else :
							wp_page_menu(
								array(
									'container'  => 'div',
									// 'menu_id'    => 'main-navigation',
									'menu_class' => 'main-navigation desktop',
									'before'     => '<ul class="nav nav-menu">',
									'walker'          => new SacchaOne_Walker_Page(),
								)
							);
						endif;
						?>

						<div class="header-controls">
						<?php do_action( 'saccha_header_control_before' ); ?>
							<!-- Button trigger modal -->
							<button class="btn btn-outline-primary navbar-toggler-open" type="button"
								data-toggle="modal" data-target="#site-navigation-mobile"
								aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'sacchaone' ); ?>">
								<span class="fa fa-bars"></span>
							</button>
							<?php if ( get_theme_mod( 'sacchaone_nav_search', 'no' ) === 'yes' ) : ?>
							<button class="btn btn-outline-primary search-toggler-open" type="button"
								data-toggle="modal" data-target="#search-modal"
								aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle search', 'sacchaone' ); ?>">
								<span class="fa fa-search"></span>
							</button>
							<?php endif; ?>
							<?php do_action( 'saccha_header_control_after' ); ?>
						</div>
					</div>
				</nav>
			</div>
		</header>
		<?php
		get_template_part( 'template-parts/modal-menu' );
		if ( get_theme_mod( 'sacchaone_nav_search', 'no' ) === 'yes' ) {
			get_template_part( 'template-parts/modal-search' );
		}
		?>
		<?php
	}
endif;
add_action( 'sacchaone_header', 'sacchaone_header', 10 );


if ( ! function_exists( 'sacchaone_footer' ) ) {

	/**
	 * SacchaOne footer callback.
	 */
	function sacchaone_footer() {
		$footer_width = get_theme_mod( 'sacchaone_footer_width', 'full' );
		$footer_social_icons = get_theme_mod( 'sacchaone_social_icons' );
		
		?>
		<!--Footer-->
		<footer class="footer footer-bg <?php echo 'box' === $footer_width ? esc_attr( 'container' ) : ''; ?>">
			<div class="footer-inner <?php echo 'full' === $footer_width ? esc_attr( 'container' ) : ''; ?>">
				<?php
				/**
				 * Hook sacchaone_footer_widgets
				 *
				 * @since 1.0
				 *
				 * @hooked sacchaone_footer_widgets - 10
				 */
				do_action( 'sacchaone_footer_widgets' );
				?>
				<div class="row copyright_info">
					<div class="col-md-<?php echo $footer_social_icons ? esc_attr( '6' ) : esc_attr( '12' ); ?>">
						<div class="mt-2">
							<?php
							if ( ! is_active_sidebar( 'copyright' ) ) {
								?>
							<div class="footer-credits">
								<p class="footer-copyright powered-by-wordpress">
									&copy;
									<?php
									echo esc_html(
										date_i18n(
										/* translators: Copyright date format, see https://secure.php.net/date */
											_x( 'Y', 'copyright date format', 'sacchaone' )
										)
									);
									?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?>.</a>
									<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'sacchaone' ) ); ?>">
									<?php echo esc_html__( 'Powered by WordPress', 'sacchaone' ); ?>
									</a>
								</p><!-- .powered-by-wordpress -->
							</div><!-- .footer-credits -->
							<?php } else { ?>
							<small><?php dynamic_sidebar( 'copyright' ); ?> </small>
							<?php } ?>
						</div>
					</div>
					<?php
						if ( $footer_social_icons ) :
					?>

					<div class="col-md-6 text-right">
						<?php
							/**
							 * Hook - sacchaone_social
							 *
							 * @hooked sacchaone_social - 10
							 */
							do_action( 'sacchaone_social' );
						?>						
						<ul>
							<?php if ( get_theme_mod('sacchaone_social_facebook_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_facebook_icon'); ?>" target="_blank">Facebook</a></li>
							<?php endif; ?>
							<?php if ( get_theme_mod('sacchaone_social_twitter_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_twitter_icon'); ?>" target="_blank">Twitter</a></li>
							<?php endif; ?>
							<?php if ( get_theme_mod('sacchaone_social_instagram_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_instagram_icon'); ?>" target="_blank">Instagram</a></li>
							<?php endif; ?>

							<?php if ( get_theme_mod('sacchaone_social_linkedin_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_linkedin_icon'); ?>" target="_blank">LinkedIn</a></li>
							<?php endif; ?>
							<?php if ( get_theme_mod('sacchaone_social_youtube_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_youtube_icon'); ?>" target="_blank">Youtube</a></li>
							<?php endif; ?>							
							<?php if ( get_theme_mod('sacchaone_social_xing_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_xing_icon'); ?>" target="_blank">Xing</a></li>
							<?php endif; ?>

							<?php if ( get_theme_mod('sacchaone_social_pinterest_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_pinterest_icon'); ?>" target="_blank">Pinterest</a></li>
							<?php endif; ?>
							<?php if ( get_theme_mod('sacchaone_social_github_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_github_icon'); ?>" target="_blank">Github</a></li>
							<?php endif; ?>
							<?php if ( get_theme_mod('sacchaone_social_tiktok_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_tiktok_icon'); ?>" target="_blank">Tiktok</a></li>
							<?php endif; ?>

							<?php if ( get_theme_mod('sacchaone_social_spotify_icon') ) : ?>
								<li><a href="<?php echo get_theme_mod('sacchaone_social_spotify_icon'); ?>" target="_blank">Spotify</a></li>
							<?php endif; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</footer>
		<?php
	}
}
add_action( 'sacchaone_footer', 'sacchaone_footer', 10 );

if ( ! function_exists( 'sacchaone_footer_widgets' ) ) {
	/**
	 * Generate footer widgets based on customizer options.
	 */
	function sacchaone_footer_widgets() {
		$widgets = get_theme_mod( 'sacchaone_footer_widgets', sacchaone_get_defaults( 'sacchaone_footer_widgets' ) );

		if ( $widgets > 0 ) :

			// If there is no active footer widgets then we don't go funther.
			if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) && ! is_active_sidebar( 'footer-4' ) && ! is_active_sidebar( 'footer-5' ) ) {
				return;
			}

			?>
			<div class="footer-widgets">
				<?php
				for ( $i = 1; $i <= $widgets; $i++ ) {
					if ( is_active_sidebar( 'footer-' . $i ) ) {
						dynamic_sidebar( 'footer-' . $i );
					}
				}
				?>
			</div>
			<hr>
			<?php
		endif;
	}

	add_action( 'sacchaone_footer_widgets', 'sacchaone_footer_widgets', 10 );
}

/**
 * Search Form
 *
 * @since 1.0.8
 */
function saccha_search_form() {
	get_search_form(
		array(
			'location' => 'navbar',
		)
	);
}
add_action( 'saccha_search_form', 'saccha_search_form' );
