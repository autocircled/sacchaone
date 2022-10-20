<?php
/**
 * SacchaOne dynamic CSS generated from Customizer.
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'sacchaone_get_dynamic_css' ) ) {

	/**
	 * Dynamic CSS
	 */
	function sacchaone_get_dynamic_css() {
		// var_dump(get_theme_mods());
		$settings = wp_parse_args(
			get_theme_mods(),
			sacchaone_get_defaults()
		);
		$css = new SacchaOne_CSS();

		// Site Title
		$css->set_selector( '.site-title' );
		$css->add_property( 'position', true === $settings['sacchaone_hide_site_title'] ? 'absolute' : 'relative' );
		$css->add_property( 'clip', true === $settings['sacchaone_hide_site_title'] ? 'rect(1px, 1px, 1px, 1px)' : 'auto' );
		
		// Site Description
		$css->set_selector( '.site-description' );
		$css->add_property( 'position', true === $settings['sacchaone_hide_site_desc'] ? 'absolute' : 'relative' );
		$css->add_property( 'clip', true === $settings['sacchaone_hide_site_desc'] ? 'rect(1px, 1px, 1px, 1px)' : 'auto' );

		// Body container width
		$css->set_selector( 'header.container, header .container, main.container, footer .container' );
		$css->add_property( 'max-width', $settings['sacchaone_container_width'] . 'px' );

		// Menu dropdown
		$css->set_selector( 'li.menu-item-has-children li:hover > ul, li.menu-item-has-children li.focus > ul, li.page_item_has_children li:hover > ul, li.page_item_has_children li.focus > ul' );
		$css->add_property( 'left', 'left' === $settings['sacchaone_dropdown_direction'] ? '-100%' : '100%' );

		$css->set_selector( 'li.menu-item-has-children:hover > ul, li.menu-item-has-children.focus > ul, li.page_item_has_children:hover > ul, li.page_item_has_children.focus > ul' );
		$css->add_property( 'left', 'left' === $settings['sacchaone_dropdown_direction'] ? 'unset' : '' );
		$css->add_property( 'right', 'left' === $settings['sacchaone_dropdown_direction'] ? '0' : '' );

		// Color section starts.
		$css->set_selector( 'body' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['background_color'] ) );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['body_text_color'] ) );

		$css->set_selector( 'body a, a:visited, i.fa' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['body_link_color'] ) );

		$css->set_selector( 'body a:hover, body a:focus, i.fa:hover' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['body_link_hover_color'] ) );

		$css->set_selector( '.header-bg, .transparent-header.sticky-nav .header-bg' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['header_background_color'] ) );

		$css->set_selector( '.site-title a, .site-title a:hover, .site-title a:focus' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['header_site_title_color'] ) );

		$css->set_selector( '.site-description' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['header_tagline_color'] ) );


		/**
		 * Navigation Color Control
		 */
		$css->set_selector( 'body .nav-header .nav-menu > li > a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['nav_text_color'] ) );

		$css->set_selector( 'body .nav-header .nav>li.open>a, body .nav-header .nav>li:hover>a' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['nav_hover_color'] ) );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['nav_text_hover_color'] ) );

		$css->start_media_query( '(min-width: 769px)' );
			$css->set_selector( 'body .nav-header .navbar .nav-wrapper ul li[class*="current-menu-"] > a, body .nav-header .navbar .nav-wrapper ul li[class*="current_page_"] > a' );
			$css->add_property( 'background-color', maybe_hash_hex_color( $settings['nav_active_color'] . '30' ) );
			$css->add_property( 'border-bottom-color', maybe_hash_hex_color( $settings['nav_active_color'] ) );
		$css->stop_media_query();

		$css->start_media_query( '(max-width: 768px)' );
			$css->set_selector( 'body .nav-header .navbar .nav-wrapper ul li[class*="current-menu-"] > a, body .nav-header .navbar .nav-wrapper ul li[class*="current_page_"] > a' );
			$css->add_property( 'background-color', maybe_hash_hex_color( $settings['nav_active_color'] . '30' ) );
			$css->add_property( 'border-left-color', maybe_hash_hex_color( $settings['nav_active_color'] ) );
			$css->add_property( 'padding-left', '15px' );
		$css->stop_media_query();

		$css->set_selector( 'body .nav-header .nav-menu li[class*="current-menu-"] > a, body .nav-header .nav-menu li[class*="current_page_"] > a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['nav_text_active_color'] ) );

		$css->set_selector( 'body .nav-header .nav-menu li li a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['nav_sub_text_color'] ) );
		
		$css->set_selector( 'body .nav-header .nav li li.open>a, body .nav-header .nav li li:hover>a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['nav_sub_text_hover_color'] ) );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['nav_sub_bg_hover_color'] ) );

		$css->set_selector( 'body .nav-header .nav-menu li li[class*="current-menu-"] > a, body .nav-header .nav-menu li li[class*="current_page_"] > a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['nav_sub_text_active_color'] ) );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['nav_sub_bg_active_color'] . '30' ) );
		$css->add_property( 'border-left-color', maybe_hash_hex_color( $settings['nav_sub_bg_active_color'] ) );

		$css->set_selector( 'body .nav-header .nav li>ul' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['nav_sub_bg_color'] ) );

		/**
		 * Navigation (Transparent) Color Control
		 */
		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav-menu > li > a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['saccha_nav_text_color_control'] ) );

		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav>li.open>a, body.transparent-header:not(.sticky-nav) .nav-header .nav>li:hover>a' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['saccha_nav_hover_color_control'] ) );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['saccha_nav_text_hover_color_control'] ) );

		$css->start_media_query( '(min-width: 769px)' );
			$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .navbar .nav-wrapper ul li[class*="current-menu-"] > a, body.transparent-header:not(.sticky-nav) .nav-header .navbar .nav-wrapper ul li[class*="current_page_"] > a' );
			$css->add_property( 'background-color', maybe_hash_hex_color( $settings['saccha_nav_active_color_control'] . '30' ) );
			$css->add_property( 'border-bottom-color', maybe_hash_hex_color( $settings['saccha_nav_active_color_control'] ) );
		$css->stop_media_query();

		$css->start_media_query( '(max-width: 768px)' );
			$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .navbar .nav-wrapper ul li[class*="current-menu-"] > a, body.transparent-header:not(.sticky-nav) .nav-header .navbar .nav-wrapper ul li[class*="current_page_"] > a' );
			$css->add_property( 'background-color', maybe_hash_hex_color( $settings['saccha_nav_active_color_control'] . '30' ) );
			$css->add_property( 'border-left-color', maybe_hash_hex_color( $settings['saccha_nav_active_color_control'] ) );
			$css->add_property( 'padding-left', '15px' );
		$css->stop_media_query();

		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav-menu li[class*="current-menu-"] > a, body.transparent-header:not(.sticky-nav) .nav-header .nav-menu li[class*="current_page_"] > a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['saccha_nav_text_active_color_control'] ) );
		
		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav-menu li li a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['saccha_nav_sub_text_color_control'] ) );
				
		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav-menu li li[class*="current-menu-"] > a, body.transparent-header:not(.sticky-nav) .nav-header .nav-menu li li[class*="current_page_"] > a' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['saccha_nav_sub_text_active_color_control'] ) );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['saccha_nav_sub_bg_active_color_control'] . '30' ) );
		$css->add_property( 'border-left-color', maybe_hash_hex_color( $settings['saccha_nav_sub_bg_active_color_control'] ) );

		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav li>ul' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['saccha_nav_sub_bg_color_control'] ) );

		$css->set_selector( 'body.transparent-header:not(.sticky-nav) .nav-header .nav li li.open>a, body.transparent-header:not(.sticky-nav) .nav-header .nav li li:hover>a' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['saccha_nav_sub_bg_hover_color_control'] ) );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['saccha_nav_sub_text_hover_color_control'] ) );
		
		/**
		 * Toggle Handle
		 */
		// Open Button
		$css->set_selector( '.navbar-toggler-open, .search-toggler-open' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_open_icon_color'] ) );
		$css->add_property( 'border-color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_open_icon_color'] ) );
		
		$css->set_selector( '.navbar-toggler-open:active, .navbar-toggler-open:hover, .navbar-toggler-open:focus, .search-toggler-open:active, .search-toggler-open:hover, .search-toggler-open:focus' );
		$css->add_property( 'color', '#fff' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_open_icon_color'] ) );
		$css->add_property( 'border-color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_open_icon_color'] ) );
		
		$css->set_selector( '.navbar-toggler-open:hover, .navbar-toggler-open:focus, .search-toggler-open:hover, .search-toggler-open:focus' );
		$css->add_property( 'box-shadow', '0 0 0 0.2rem ' . maybe_hash_hex_color( $settings['sacchaone_nav_toggle_open_icon_color'] ) . '80' );

		// Close Button
		$css->set_selector( '.saccha-btn-close' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_close_icon_color'] ) );
		$css->add_property( 'border-color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_close_icon_color'] ) );
		
		$css->set_selector( '.saccha-btn-close:not(:disabled):not(.disabled).active, .saccha-btn-close:not(:disabled):not(.disabled):active, .saccha-btn-close:active, .saccha-btn-close:hover, .saccha-btn-close:focus' );
		$css->add_property( 'color', '#fff' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_close_icon_color'] ) );
		$css->add_property( 'border-color', maybe_hash_hex_color( $settings['sacchaone_nav_toggle_close_icon_color'] ) );
		
		$css->set_selector( '.saccha-btn-close:hover, .saccha-btn-close:focus' );
		$css->add_property( 'box-shadow', '0 0 0 0.2rem ' . maybe_hash_hex_color( $settings['sacchaone_nav_toggle_close_icon_color'] ) . '80' );

		/**
		 * Buttons Color
		 */
		$css->set_selector( '.scroll-to-top i.fa' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['sacchaone_back2top_icon_color'] ) );
		
		$css->set_selector( '.scroll-to-top:hover i.fa' );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['sacchaone_back2top_icon_h_color'] ) );
		
		$css->set_selector( '.scroll-to-top' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['sacchaone_back2top_bg_color'] ) );
		
		$css->set_selector( '.scroll-to-top:hover' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['sacchaone_back2top_bg_h_color'] ) );
		
		/**
		 * Buttons Color
		 */
		$css->set_selector( 'input[type="submit"], form.comment-form .form-submit input.submit, .wp-block-search__button' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['button_bg_color'] ) );
		$css->add_property( 'border-color', maybe_hash_hex_color( $settings['button_border_color'] ) );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['button_text_color'] ) );

		$css->set_selector( 'input[type="submit"]:focus, input[type="submit"]:active, input[type="submit"]:hover, form.comment-form .form-submit input.submit:focus, form.comment-form .form-submit input.submit:active, form.comment-form .form-submit input.submit:hover, .wp-block-search__button:focus, .wp-block-search__button:hover, .wp-block-search__button:active' );
		$css->add_property( 'background-color', maybe_hash_hex_color( $settings['button_bg_hover_color'] ) );
		$css->add_property( 'border-color', maybe_hash_hex_color( $settings['button_border_hover_color'] ) );
		$css->add_property( 'color', maybe_hash_hex_color( $settings['button_text_hover_color'] ) );

		$css->set_selector( 'ul.social-icons svg' );
		$css->add_property( 'width', $settings['sacchaone_social_icon_size'] . 'px' );
		$css->add_property( 'height', $settings['sacchaone_social_icon_size'] . 'px' );
		$css->add_property( 'fill', $settings['sacchaone_icon_color_setting'] );

		$css->set_selector( 'ul.social-icons svg:hover' );
		$css->add_property( 'fill', $settings['sacchaone_icon_hover_color_setting'] );

		return $css->css_output();
	}
}

if ( ! function_exists( 'sacchaone_get_defaults' ) ) {

	/**
	 * Get default theme settings.
	 *
	 * @param string $key Return key based value.
	 */
	function sacchaone_get_defaults( $key = false ) {
		$defaults = array(
			'sacchaone_header_preset'      => 'default',
			'sacchaone_header_width'       => 'full',
			'sacchaone_footer_width'       => 'full',
			'sacchaone_container_width'    => '1200',
			'sacchaone_footer_widgets'     => '3',
			'sacchaone_back2top'           => 0,
			'sacchaone_social_icons'       => 0,
			'sacchaone_sidebar_settings'   => 'default',
			'sacchaone_sidebar_type'       => 'sidebar-type-default',
			'sacchaone_hide_site_title'    => false,
			'sacchaone_hide_site_desc'     => true,
			'sacchaone_blog_settings'      => 'excerpt',
			'sacchaone_dropdown_direction' => 'right',
			'sacchaone_sticky_nav'         => 'enabled',
			'sacchaone_social_icon_size'   => 24,
			'sacchaone_icon_color_setting' => '#b4c1d0',
			'sacchaone_icon_hover_color_setting' => '#fff',
			'background_color'             => '#f0f0f1',
			'body_text_color'              => '#1f1f1f',
			'body_link_color'              => '#117889',
			'body_link_hover_color'        => '#128294',
			'header_background_color'      => '#fff',
			'header_site_title_color'      => '#1f1f1f',
			'header_tagline_color'         => '#1f1f1f',
			// 'nav_background_color'         => '#fff',
			'nav_hover_color'              => '#fff',
			'nav_active_color'             => '#3582c4',
			'nav_text_color'               => '#030303',
			'nav_text_hover_color'         => '#030303',
			'nav_text_active_color'        => '#030303',
			'nav_sub_text_color'           => '#030303',
			'nav_sub_text_hover_color'     => '#030303',
			'nav_sub_text_active_color'    => '#030303',
			'nav_sub_bg_color'             => '#fff',
			'nav_sub_bg_hover_color'       => '#f5f5f5',
			'nav_sub_bg_active_color'      => '#3582c4',
			// Transparent Nav Color
			'saccha_nav_text_color_control'            => '#030303',
			'saccha_nav_hover_color_control'           => '#fff',
			'saccha_nav_active_color_control'          => '#3582c4',
			'saccha_nav_text_hover_color_control'      => '#030303',
			'saccha_nav_text_active_color_control'     => '#030303',
			'saccha_nav_sub_text_color_control'        => '#030303',
			'saccha_nav_sub_text_hover_color_control'  => '#030303',
			'saccha_nav_sub_text_active_color_control' => '#3582c4',
			'saccha_nav_sub_bg_color_control'          => '#fff',
			'saccha_nav_sub_bg_hover_color_control'    => '#f5f5f5',
			'saccha_nav_sub_bg_active_color_control'   => '#3582c4',
			'sacchaone_nav_toggle_open_icon_color'     => '#128294',
			'sacchaone_nav_toggle_close_icon_color'    => '#b85d13',
			'button_bg_color'              			   => '#128294',
			'button_bg_hover_color'        			   => '#fff',
			'button_text_color'           			   => '#fff',
			'button_text_hover_color'     			   => '#128294',
			'button_border_color'          			   => '#128294',
			'button_border_hover_color'   			   => '#128294',
			'default_bg_color'			   			   => '#fff',
			'sacchaone_back2top_icon_color'			   => '#117889',
			'sacchaone_back2top_icon_h_color'		   => '#fff',
			'sacchaone_back2top_bg_color'	 		   => '#fff',
			'sacchaone_back2top_bg_h_color'  		   => '#117889',

			// 404
			'sacchaone_404_title'          			   => __( '404', 'sacchaone' ),
			'sacchaone_404_subtitle'       			   => __( 'Oops! Looks like this is a dead end. And we know that.', 'sacchaone' ),
			'sacchaone_404_desc'          			   => __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sacchaone' ),
			'sacchaone_load_more_text'     			   => __( 'Load more', 'sacchaone' ),

		);

		$settings = wp_parse_args(
			get_theme_mods(),
			$defaults
		);

		if ( $key ) {
			return $settings[ $key ];
		} else {
			return apply_filters( 'sacchaone_get_customizer_defaults', $settings );
		}
	}
}
// remove_theme_mods(); // @codingStandardsIgnoreLine
