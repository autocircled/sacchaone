<?php
/**
 * SacchaOne dynamic CSS generated from Customizer.
 *
 * @package sacchaone
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'sacchaone_get_dynamic_css' ) ) {

	/**
	 * Dynamic CSS
	 */
	function sacchaone_get_dynamic_css() {
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
		$css->add_property( 'background-color', $settings['background_color'] );
		$css->add_property( 'color', $settings['body_text_color'] );

		$css->set_selector( 'body a' );
		$css->add_property( 'color', $settings['body_link_color'] );

		$css->set_selector( 'body a:hover, body a:focus' );
		$css->add_property( 'color', $settings['body_link_hover_color'] );

		$css->set_selector( '.header-bg' );
		$css->add_property( 'background-color', $settings['header_background_color'] );

		$css->set_selector( '.site-title a, .site-title a:hover, .site-title a:focus' );
		$css->add_property( 'color', $settings['header_site_title_color'] );

		$css->set_selector( '.site-description' );
		$css->add_property( 'color', $settings['header_tagline_color'] );

		$css->set_selector( '.navbar-collapse' );
		$css->add_property( 'background-color', $settings['nav_background_color'] );

		$css->set_selector( '.nav>li.open>a, .nav>li:hover>a' );
		$css->add_property( 'background-color', $settings['nav_hover_color'] );

		$css->start_media_query( '(min-width: 769px)' );
			$css->set_selector( '.navbar .navbar-collapse ul li[class*="current-menu-"] > a, .navbar .navbar-collapse ul li[class*="current_page_"] > a' );
			$css->add_property( 'background-color', $settings['nav_active_color'] . '30' );
			$css->add_property( 'border-bottom-color', $settings['nav_active_color'] );
		$css->stop_media_query();

		$css->start_media_query( '(max-width: 768px)' );
			$css->set_selector( '.navbar .navbar-collapse ul li[class*="current-menu-"] > a, .navbar .navbar-collapse ul li[class*="current_page_"] > a' );
			$css->add_property( 'background-color', $settings['nav_active_color'] . '30' );
			$css->add_property( 'border-left-color', $settings['nav_active_color'] );
			$css->add_property( 'padding-left', '15px' );
		$css->stop_media_query();

		$css->set_selector( '.nav.navbar-nav li a' );
		$css->add_property( 'color', $settings['nav_text_color'] );

		$css->set_selector( '.nav>li.open>a, .nav>li:hover>a' );
		$css->add_property( 'color', $settings['nav_text_hover_color'] );

		$css->set_selector( '.nav.navbar-nav li.current_page_item a' );
		$css->add_property( 'color', $settings['nav_text_active_color'] );

		$css->set_selector( '.nav li>ul' );
		$css->add_property( 'background-color', $settings['nav_sub_bg_color'] );

		$css->set_selector( '.nav li li.open>a, .nav li li:hover>a' );
		$css->add_property( 'background-color', $settings['nav_sub_bg_hover_color'] );

		$css->set_selector( '.nav.navbar-nav li li.current_page_ancestor > a, .nav.navbar-nav li li.current_page_item > a' );
		$css->add_property( 'background-color', $settings['nav_sub_bg_active_color'] . '30' );
		$css->add_property( 'border-left-color', $settings['nav_sub_bg_active_color'] );

		$css->set_selector( '.nav.navbar-nav li li a' );
		$css->add_property( 'color', $settings['nav_sub_text_color'] );

		$css->set_selector( '.nav li li.open>a, .nav li li:hover>a' );
		$css->add_property( 'color', $settings['nav_sub_text_hover_color'] );

		$css->set_selector( '.nav.navbar-nav li li.current_page_ancestor > a, .nav.navbar-nav li li.current_page_item > a' );
		$css->add_property( 'color', $settings['nav_sub_text_active_color'] );

		$css->set_selector( 'input[type="submit"], form.comment-form .form-submit input.submit, .wp-block-search__button' );
		$css->add_property( 'background-color', $settings['button_bg_color'] );
		$css->add_property( 'border-color', $settings['button_border_color'] );
		$css->add_property( 'color', $settings['button_text_color'] );

		$css->set_selector( 'input[type="submit"]:focus, input[type="submit"]:active, input[type="submit"]:hover, form.comment-form .form-submit input.submit:focus, form.comment-form .form-submit input.submit:active, form.comment-form .form-submit input.submit:hover, .wp-block-search__button:focus, .wp-block-search__button:hover, .wp-block-search__button:active' );
		$css->add_property( 'background-color', $settings['button_bg_hover_color'] );
		$css->add_property( 'border-color', $settings['button_border_hover_color'] );
		$css->add_property( 'color', $settings['button_text_hover_color'] );

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
			'sacchaone_header_width'       => 'box',
			'sacchaone_footer_width'       => 'full',
			'sacchaone_container_width'    => '1200',
			'sacchaone_footer_widgets'     => '3',
			'sacchaone_back2top'           => 0,
			'sacchaone_sidebar_settings'   => 'default',
			'sacchaone_hide_site_title'    => false,
			'sacchaone_hide_site_desc'     => true,
			'sacchaone_blog_settings'      => 'excerpt',
			'sacchaone_dropdown_direction' => 'right',
			'background_color'             => '#f0f0f1',
			'body_text_color'              => '#1f1f1f',
			'body_link_color'              => '#117889',
			'body_link_hover_color'        => '#128294',
			'header_background_color'      => '#fff',
			'header_site_title_color'      => '#1f1f1f',
			'header_tagline_color'         => '#1f1f1f',
			'nav_background_color'         => '#fff',
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
			'button_bg_color'              => '#128294',
			'button_bg_hover_color'        => '#fff',
			'button_text_color'            => '#fff',
			'button_text_hover_color'      => '#128294',
			'button_border_color'          => '#128294',
			'button_border_hover_color'    => '#128294',
			// 404
			'sacchaone_404_title'          => __( '404', 'sacchaone' ),
			'sacchaone_404_subtitle'       => __( 'Oops! Looks like this is a dead end. And we know that.', 'sacchaone' ),
			'sacchaone_404_desc'           => __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sacchaone' ),
			'sacchaone_load_more_text'     => __( 'Load more', 'sacchaone' ),

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
