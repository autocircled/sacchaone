<?php
/**
 * SacchaOne Theme Customizer
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer oblorject.
 */
function sacchaone_customize_register( $wp_customize ) {

	$defaults = sacchaone_get_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'sacchaone_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'sacchaone_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Setting: for Title and Description
	 */
	$wp_customize->add_setting(
		'sacchaone_hide_site_title',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_hide_site_title'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'sacchaone_hide_site_title',
		array(
			'label'    => esc_html__( 'Hide Title', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_hide_site_title',
			'type'     => 'checkbox',

		)
	);

	$wp_customize->add_setting(
		'sacchaone_hide_site_desc',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_hide_site_desc'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'sacchaone_hide_site_desc',
		array(
			'label'    => esc_html__( 'Hide Tagline', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_hide_site_desc',
			'type'     => 'checkbox',
		)
	);

	/**
	 * Setting and Control for Site Title Font Size 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_font_size',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_title_font_size'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_title_font_size',
		array(
			'label'    => esc_html__( 'Site Title Font Size', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_title_font_size',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Title Font Color 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_font_color',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_title_font_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'sacchaone_site_title_font_color',
			array(
				'label'    => esc_html__( 'Site Title Color', 'sacchaone' ),
				'section'  => 'title_tagline',
				'settings' => 'sacchaone_site_title_font_color',
			)
		)
	);

	/**
	 * Setting and Control for Site Tagline Font Size 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_font_size',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_tagline_font_size'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_tagline_font_size',
		array(
			'label'    => esc_html__( 'Site Tagline Font Size', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_tagline_font_size',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Tagline Font Color 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_font_color',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_tagline_font_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'sacchaone_site_tagline_font_color',
			array(
				'label'    => esc_html__( 'Site Tagline Color', 'sacchaone' ),
				'section'  => 'title_tagline',
				'settings' => 'sacchaone_site_tagline_font_color',
			)
		)
	);

	 /**
	 * Setting and Control for Site Title Padding Text. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_pad_text',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'			=>'',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_title_pad_text',
		array(
			'label'    => esc_html__( 'Site Title Padding (px)', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_title_pad_text',
			'type'     => 'hidden',
		)
	);

	/**
	 * Setting and Control for Site Title Top Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_top_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_title_top_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_title_top_pad',
		array(
			'label'    => esc_html__( 'Top', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_title_top_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Title Right Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_right_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_title_right_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_title_right_pad',
		array(
			'label'    => esc_html__( 'Right', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_title_right_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Title Bottom Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_bottom_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_title_bottom_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_title_bottom_pad',
		array(
			'label'    => esc_html__( 'Bottom', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_title_bottom_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Title Left Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_title_left_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_title_left_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_title_left_pad',
		array(
			'label'    => esc_html__( 'Left', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_title_left_pad',
			'type'     => 'number',
		)
	);

	 /**
	 * Setting and Control for Site Tagline Padding Text. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_pad_text',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'			=>'',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_tagline_pad_text',
		array(
			'label'    => esc_html__( 'Site Tagline Padding (px)', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_tagline_pad_text',
			'type'     => 'hidden',
		)
	);

	/**
	 * Setting and Control for Site Tagline Top Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_top_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_tagline_top_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_tagline_top_pad',
		array(
			'label'    => esc_html__( 'Top', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_tagline_top_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Tagline Right Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_right_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_tagline_right_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_tagline_right_pad',
		array(
			'label'    => esc_html__( 'Right', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_tagline_right_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Tagline Bottom Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_bottom_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_tagline_bottom_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_tagline_bottom_pad',
		array(
			'label'    => esc_html__( 'Bottom', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_tagline_bottom_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Tagline Left Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_tagline_left_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_tagline_left_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_tagline_left_pad',
		array(
			'label'    => esc_html__( 'Left', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_tagline_left_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Logo Padding Text. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_logo_pad_title',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'			=>'',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_logo_pad_title',
		array(
			'label'    => esc_html__( 'Logo Padding (px)', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_logo_pad_title',
			'type'     => 'hidden',
		)
	);

	/**
	 * Setting and Control for Site Logo Top Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_logo_top_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_logo_top_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_logo_top_pad',
		array(
			'label'    => esc_html__( 'Top', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_logo_top_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Logo Right Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_logo_right_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_logo_right_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_logo_right_pad',
		array(
			'label'    => esc_html__( 'Right', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_logo_right_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Logo Bottom Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_logo_bottom_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_logo_bottom_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_logo_bottom_pad',
		array(
			'label'    => esc_html__( 'Bottom', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_logo_bottom_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Setting and Control for Site Logo Left Padding. 
	 */
	$wp_customize->add_setting(
		'sacchaone_site_logo_left_pad',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_site_logo_left_pad'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_site_logo_left_pad',
		array(
			'label'    => esc_html__( 'Left', 'sacchaone' ),
			'section'  => 'title_tagline',
			'settings' => 'sacchaone_site_logo_left_pad',
			'type'     => 'number',
		)
	);

	/**
	 * Panel: Layout
	 */
	$wp_customize->add_panel(
		'sacchaone_layout',
		array(
			'title'    => esc_html__( 'Layout', 'sacchaone' ),
			'priority' => 30,
		)
	);

	/**
	 * Section: Container
	 */
	$wp_customize->add_section(
		'sacchaone_layout_section',
		array(
			'title' => esc_html__( 'Container', 'sacchaone' ),
			'panel' => 'sacchaone_layout',
		)
	);

	/**
	 * Setting: for Container Width
	 */
	$wp_customize->add_setting(
		'sacchaone_container_width',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_container_width'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	/**
	 * Control: Container Width
	 */
	$wp_customize->add_control(
		new SacchaOne_Range_Control(
			$wp_customize,
			'sacchaone_container_width',
			array(
				'label'       => esc_html__( 'Container Width', 'sacchaone' ),
				'section'     => 'sacchaone_layout_section',
				'settings'    => 'sacchaone_container_width',
				'description' => esc_html__( 'Measurement is in pixel.', 'sacchaone' ),
				'input_attrs' => array(
					'min' => 700,
					'max' => 2000,
				),
			)
		)
	);

	/**
	 * Section: Header
	 */
	$wp_customize->add_section(
		'sacchaone_header_section',
		array(
			'title' => esc_html__( 'Header', 'sacchaone' ),
			'panel' => 'sacchaone_layout',
		)
	);

	/**
	 * Setting: for Header Preset
	 */
	$wp_customize->add_setting(
		'sacchaone_header_preset',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_header_preset'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_header_preset',
		array(
			'label'    => esc_html__( 'Header Preset', 'sacchaone' ),
			'section'  => 'sacchaone_header_section',
			'settings' => 'sacchaone_header_preset',
			'type'     => 'select',
			'choices'  => array(
				'default'       => esc_html__( 'Default', 'sacchaone' ),
				'top'           => esc_html__( 'Navigation Top', 'sacchaone' ),
				'top_center'    => esc_html__( 'Navigation Top Center', 'sacchaone' ),
				'bottom'        => esc_html__( 'Navigation Bottom', 'sacchaone' ),
				'bottom_center' => esc_html__( 'Navigation Bottom Center', 'sacchaone' ),
				'left'          => esc_html__( 'Navigation Left', 'sacchaone' ),
			),
		)
	);

	/**
	 * Setting: for Header Width
	 */
	$wp_customize->add_setting(
		'sacchaone_header_width',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_header_width'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_header_width',
		array(
			'label'    => esc_html__( 'Header Width', 'sacchaone' ),
			'section'  => 'sacchaone_header_section',
			'settings' => 'sacchaone_header_width',
			'type'     => 'select',
			'choices'  => array(
				'box'  => esc_html__( 'Boxed', 'sacchaone' ),
				'full' => esc_html__( 'Full', 'sacchaone' ),
			),
		)
	);

	/**
	 * Section: Navigation
	 */
	$wp_customize->add_section(
		'sacchaone_nav_section',
		array(
			'title' => esc_html__( 'Navigation', 'sacchaone' ),
			'panel' => 'sacchaone_layout',
		)
	);

	$wp_customize->add_setting(
		'sacchaone_sticky_nav',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => 'enable',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_sticky_nav',
		array(
			'label'    => esc_html__( 'Sticky Navigation', 'sacchaone' ),
			'section'  => 'sacchaone_nav_section',
			'settings' => 'sacchaone_sticky_nav',
			'type'     => 'select',
			'choices'  => array(
				'enable'  => esc_html__( 'Enable', 'sacchaone' ),
				'disable' => esc_html__( 'Disable', 'sacchaone' ),
			),
		)
	);

	$wp_customize->add_setting(
		'sacchaone_dropdown_direction',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => 'right',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_dropdown_direction',
		array(
			'label'    => esc_html__( 'Dropdown Direction', 'sacchaone' ),
			'section'  => 'sacchaone_nav_section',
			'settings' => 'sacchaone_dropdown_direction',
			'type'     => 'select',
			'choices'  => array(
				'left'  => esc_html__( 'Left', 'sacchaone' ),
				'right' => esc_html__( 'Right', 'sacchaone' ),
			),
		)
	);

	/**
	 * Setting: for Navigation Search
	 */
	$wp_customize->add_setting(
		'sacchaone_nav_search',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => 'no',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_nav_search',
		array(
			'label'    => esc_html__( 'Navigation Search', 'sacchaone' ),
			'section'  => 'sacchaone_nav_section',
			'settings' => 'sacchaone_nav_search',
			'type'     => 'select',
			'choices'  => array(
				'yes' => esc_html__( 'Enable', 'sacchaone' ),
				'no'  => esc_html__( 'Disable', 'sacchaone' ),
			),
		)
	);

	/**
	 * Section: Footer
	 */
	$wp_customize->add_section(
		'sacchaone_footer_section',
		array(
			'title' => esc_html__( 'Footer', 'sacchaone' ),
			'panel' => 'sacchaone_layout',
		)
	);

	/**
	 * Setting: for Footer Width
	 */
	$wp_customize->add_setting(
		'sacchaone_footer_width',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_footer_width'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_footer_width',
		array(
			'label'    => esc_html__( 'Footer Width', 'sacchaone' ),
			'section'  => 'sacchaone_footer_section',
			'settings' => 'sacchaone_footer_width',
			'type'     => 'select',
			'choices'  => array(
				'box'  => esc_html__( 'Boxed', 'sacchaone' ),
				'full' => esc_html__( 'Full', 'sacchaone' ),
			),
		)
	);

	/**
	 * Setting: for Footer Widgets
	 */
	$wp_customize->add_setting(
		'sacchaone_footer_widgets',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_footer_widgets'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_footer_widgets',
		array(
			'label'    => esc_html__( 'Footer Widgets', 'sacchaone' ),
			'section'  => 'sacchaone_footer_section',
			'settings' => 'sacchaone_footer_widgets',
			'type'     => 'select',
			'choices'  => array(
				0 => esc_html__( '0', 'sacchaone' ),
				1 => esc_html__( '1', 'sacchaone' ),
				2 => esc_html__( '2', 'sacchaone' ),
				3 => esc_html__( '3', 'sacchaone' ),
				4 => esc_html__( '4', 'sacchaone' ),
				5 => esc_html__( '5', 'sacchaone' ),
			),
		)
	);

	/**
	 * Setting: for Back to Top Button
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top',
		array(
			'label'    => esc_html__( 'Back to Top Button', 'sacchaone' ),
			'section'  => 'sacchaone_footer_section',
			'settings' => 'sacchaone_back2top',
			'type'     => 'select',
			'choices'  => array(
				1 => esc_html__( 'Enable', 'sacchaone' ),
				0 => esc_html__( 'Disable', 'sacchaone' ),
			),
		)
	);

	// /**
	//  * Setting: for Back to Top Checkbox Button
	//  */
	// $wp_customize->add_setting(
	// 	'sacchaone_back2top_checkbox',
	// 	array(
	// 		'type'              => 'option',
	// 		'capability'        => 'edit_theme_options',
	// 		'default'           => '',
	// 		'transport'         => 'postMessage',
	// 	)
	// );

	// $wp_customize->add_control(
	// 	'sacchaone_back2top_checkbox',
	// 	array(
	// 		'label'    => esc_html__( 'Back to Top Button', 'sacchaone' ),
	// 		'section'  => 'sacchaone_footer_section',
	// 		'settings' => 'sacchaone_back2top_checkbox',
	// 		'type'     => 'checkbox',
	// 		'choices'  => array(
	// 				'check' => esc_html__( 'Back to Top Button','sacchaone'),
	// 		),
	// 	)
	// );

	/**
	 * Setting: for Back to Top Font Awesome Icon.
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_arrow',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_arrow'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_arrow',
		array(
			'label'    		=> esc_html__( 'Font Awesome Icon', 'sacchaone' ),
			'description'   => wp_kses_post( sprintf(
				'<a href ="https://fontawesome.com/v4/icons/" target="_blank">%s</a>',
				__( 'Available Font Awesome Icons', 'sacchaone' )
			) ),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_arrow',
			'type'     		=> 'text',
		)
	);

	/**
	 * Setting: for Back to Top Icon position - Horizontal
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_position',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_position'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_position',
		array(
			'label'	   		=> esc_html__( 'Position','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_position',
			'type'     		=> 'select',
			'choices'  		=> array(
						'left' 		=> esc_html__( 'Left','sacchaone'),
						'center' 	=> esc_html__( 'Center','sacchaone'),
						'right' 	=> esc_html__( 'Right','sacchaone'),
			),
		)
	);

	/**
	 * Setting: for Back to Top Button Horizontal Spacing.
	 */

	$wp_customize->add_setting(
		'sacchaone_back2top_horizon_spacing',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_horizon_spacing'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_horizon_spacing',
		array(
			'label'	   		=> esc_html__( 'Horizontal Spacing','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_horizon_spacing',
			'type'			=> 'number',
			'input_attrs' => array(
				'min' => 0,
			),
		)
	);

	/**
	 * Setting: for Back to Top Icon position - Vertical
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_vertical_position',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_vertical_position'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_vertical_position',
		array(
			'label'	   		=> esc_html__( 'Bottom Position (px)','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_vertical_position',
			'type'			=> 'number',
			'input_attrs' => array(
				'min' => 0,
			),
		)
	);

	/**
	 * Setting: for Back to Top Button Size
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_button_size',
		array(
			'type'				=> 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_button_size'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_button_size',
		array(
			'label'	   		=> esc_html__( 'Button Size (px)','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_button_size',
			'type'			=> 'number',
			'input_attrs' => array(
				'min' 	=> 0,
			),
		)
	);

	/**
	 * Setting: for Back to Top Button Opacity
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_button_opacity',
		array(
			'type'				=> 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_button_opacity'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_button_opacity',
		array(
			'label'	   		=> esc_html__( 'Button Opacity','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_button_opacity',
			'type'			=> 'number',
			'input_attrs' => array(
				'min' 	=> 0,
				'max'	=> 1.0,
				'step' => 0.1,
			),
		)
	);

	/**
	 * Setting: for Back to Top Icon Size
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_icon_size',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_icon_size'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_icon_size',
		array(
			'label'	   		=> esc_html__( 'Icon Size (px)','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_icon_size',
			'type'			=> 'number',
			'input_attrs' => array(
				'min' => 10,
			),
		)
	);

	/**
	 * Setting: for Back to Top Icon Border Radius
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_icon_radius',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_back2top_icon_radius'],
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'sacchaone_back2top_icon_radius',
		array(
			'label'	   		=> esc_html__( 'Border Radius (px)','sacchaone'),
			'section'  		=> 'sacchaone_footer_section',
			'settings' 		=> 'sacchaone_back2top_icon_radius',
			'type'			=> 'number',
			'input_attrs' => array(
				'min' => 0,
			),
		)
	);
	
	/**
	 * Back to Top icon background color, background hove color, icon color and icon hover color
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_bg_color',
		array(
			'default'           => $defaults['default_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sacchaone_back2top_bg_color',
			array(
				'label'    => esc_html__( 'Background Color', 'sacchaone' ),
				'section'  => 'sacchaone_footer_section',
				'settings' => 'sacchaone_back2top_bg_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'sacchaone_back2top_bg_h_color',
		array(
			'default'           => $defaults['body_link_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sacchaone_back2top_bg_h_color',
			array(
				'label'    => esc_html__( 'Background Hover Color', 'sacchaone' ),
				'section'  => 'sacchaone_footer_section',
				'settings' => 'sacchaone_back2top_bg_h_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'sacchaone_back2top_icon_color',
		array(
			'default'           => $defaults['body_link_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sacchaone_back2top_icon_color',
			array(
				'label'    => esc_html__( 'Icon Color', 'sacchaone' ),
				'section'  => 'sacchaone_footer_section',
				'settings' => 'sacchaone_back2top_icon_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'sacchaone_back2top_icon_h_color',
		array(
			'default'           => $defaults['default_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sacchaone_back2top_icon_h_color',
			array(
				'label'    => esc_html__( 'Icon Hover Color', 'sacchaone' ),
				'section'  => 'sacchaone_footer_section',
				'settings' => 'sacchaone_back2top_icon_h_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Section: Sidebar
	 */
	$wp_customize->add_section(
		'sacchaone_sidebar_section',
		array(
			'title' => esc_html__( 'Sidebar', 'sacchaone' ),
			'panel' => 'sacchaone_layout',
		)
	);

	/**
	 * Setting: for Sidebar
	 *
	 * @todo Need to add more controls for different sidebars
	 */
	$wp_customize->add_setting(
		'sacchaone_sidebar_settings',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_sidebar_settings'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_sidebar_settings',
		array(
			'label'    => esc_html__( 'Sidebar Layout', 'sacchaone' ),
			'section'  => 'sacchaone_sidebar_section',
			'settings' => 'sacchaone_sidebar_settings',
			'type'     => 'select',
			'choices'  => array(
				'default'       => esc_html__( 'Default', 'sacchaone' ),
				'right-sidebar' => esc_html__( 'Right Sidebar', 'sacchaone' ),
				'left-sidebar'  => esc_html__( 'Left Sidebar', 'sacchaone' ),
				'both-sidebar'  => esc_html__( 'Both Sidebar', 'sacchaone' ),
				'no-sidebar'    => esc_html__( 'No Sidebar', 'sacchaone' ),
			),
		)
	);

	$wp_customize->add_setting(
		'sacchaone_sidebar_type',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_sidebar_type'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_sidebar_type',
		array(
			'label'    => esc_html__( 'Sidebar Type', 'sacchaone' ),
			'section'  => 'sacchaone_sidebar_section',
			'settings' => 'sacchaone_sidebar_type',
			'type'     => 'select',
			'choices'  => array(
				'sidebar-type-default'   => esc_html__( 'Default', 'sacchaone' ),
				'sidebar-type-boxed'     => esc_html__( 'Boxed', 'sacchaone' ),
				'sidebar-type-separated' => esc_html__( 'Separated', 'sacchaone' ),
			),
		)
	);

	/**
	 * Section: Blog
	 */
	$wp_customize->add_section(
		'sacchaone_blog_section',
		array(
			'title'           => esc_html__( 'Blog', 'sacchaone' ),
			'panel'           => 'sacchaone_layout',
			'active_callback' => 'is_archive',
		)
	);

	/**
	 * Setting: for Blog
	 */
	$wp_customize->add_setting(
		'sacchaone_blog_settings',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_blog_settings'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_blog_settings',
		array(
			'label'    => esc_html__( 'Blog Content', 'sacchaone' ),
			'section'  => 'sacchaone_blog_section',
			'settings' => 'sacchaone_blog_settings',
			'type'     => 'select',
			'choices'  => array(
				'excerpt'      => esc_html__( 'Excerpt', 'sacchaone' ),
				'full-content' => esc_html__( 'Full Content', 'sacchaone' ),
			),
		)
	);

	// Moved Homepage Setting
	$static_home_page = $wp_customize->get_section( 'static_front_page' );
	$static_home_page->panel = 'sacchaone_layout';
	$static_home_page->priority = 200;

	/**
	 * Section: Colors
	 * Setting: Body
	 */
	$wp_customize->add_setting(
		'sacchaone_body_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'sacchaone_body_color_control',
			array(
				'label'      => esc_html__( 'Body', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_body_color',
				'priority'   => 1,
				'toggle_ids' => array(
					'background_color',
					'body_text_color_control',
					'body_link_color_control',
					'body_link_hover_color_control',
				),
			)
		)
	);

	$wp_customize->add_setting(
		'body_text_color',
		array(
			'default'           => $defaults['body_text_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_text_color_control',
			array(
				'label'    => esc_html__( 'Text', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'body_text_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'body_link_color',
		array(
			'default'           => $defaults['body_link_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_link_color_control',
			array(
				'label'    => esc_html__( 'Link', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'body_link_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'body_link_hover_color',
		array(
			'default'           => $defaults['body_link_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_link_hover_color_control',
			array(
				'label'    => esc_html__( 'Link Hover', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'body_link_hover_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Setting: Header Toggle
	 */
	$wp_customize->add_setting(
		'sacchaone_header_color',
		array(
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'header_color_control',
			array(
				'label'      => esc_html__( 'Header', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_header_color',
				'toggle_ids' => array(
					'header_background_colorr_control',
					'header_site_title_color_control',
					'header_tagline_color_control',
				),
			)
		)
	);

	$wp_customize->add_setting(
		'header_background_color',
		array(
			'default'           => $defaults['header_background_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_colorr_control',
			array(
				'label'    => esc_html__( 'Background', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'header_background_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'header_site_title_color',
		array(
			'default'           => $defaults['header_site_title_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_site_title_color_control',
			array(
				'label'    => esc_html__( 'Site Title', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'header_site_title_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'header_tagline_color',
		array(
			'default'           => $defaults['header_tagline_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_tagline_color_control',
			array(
				'label'    => esc_html__( 'Tagline', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'header_tagline_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Setting: Navigation Toggle
	 */
	$wp_customize->add_setting(
		'sacchaone_navigation_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'navigation_color_control',
			array(
				'label'      => esc_html__( 'Navigation with Sticky', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_navigation_color',
				'toggle_ids' => array(
					'nav_text_color_control',
					'nav_hover_color_control',
					'nav_active_color_control',
					'nav_text_hover_color_control',
					'nav_text_active_color_control',
					'nav_sub_text_color_control',
					'nav_sub_text_active_color_control',
					'nav_sub_text_hover_color_control',
					'nav_sub_bg_color_control',
					'nav_sub_bg_active_color_control',
					'nav_sub_bg_hover_color_control',
				),
			)
		)
	);

	$wp_customize->add_setting(
		'nav_text_color',
		array(
			'default'           => $defaults['nav_text_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_text_color_control',
			array(
				'label'    => esc_html__( 'Text Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_text_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_hover_color',
		array(
			'default'           => $defaults['nav_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_hover_color_control',
			array(
				'label'    => esc_html__( 'Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_hover_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_active_color',
		array(
			'default'           => $defaults['nav_active_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_active_color_control',
			array(
				'label'    => esc_html__( 'Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_active_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_text_hover_color',
		array(
			'default'           => $defaults['nav_text_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_text_hover_color_control',
			array(
				'label'    => esc_html__( 'Text Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_text_hover_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_text_active_color',
		array(
			'default'           => $defaults['nav_text_active_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_text_active_color_control',
			array(
				'label'    => esc_html__( 'Text Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_text_active_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_sub_text_color',
		array(
			'default'           => $defaults['nav_sub_text_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_sub_text_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Text Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_sub_text_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_sub_text_hover_color',
		array(
			'default'           => $defaults['nav_sub_text_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_sub_text_hover_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Text Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_sub_text_hover_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_sub_text_active_color',
		array(
			'default'           => $defaults['nav_sub_text_active_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_sub_text_active_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Text Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_sub_text_active_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_sub_bg_color',
		array(
			'default'           => $defaults['nav_sub_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_sub_bg_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Background Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_sub_bg_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_sub_bg_hover_color',
		array(
			'default'           => $defaults['nav_sub_bg_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_sub_bg_hover_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Background Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_sub_bg_hover_color',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'nav_sub_bg_active_color',
		array(
			'default'           => $defaults['nav_sub_bg_active_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_sub_bg_active_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Background Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'nav_sub_bg_active_color',
				'priority' => 10,
			)
		)
	);

	
	/**
	 * Setting: Transparent Navigation Toggle
	 */
	$wp_customize->add_setting(
		'sacchaone_saccha_navigation_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'sacchaone_saccha_navigation_color',
			array(
				'label'      => esc_html__( 'Navigation (Transparent)', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_saccha_navigation_color',
				'toggle_ids' => array(
					'saccha_nav_text_color_control',
					'saccha_nav_hover_color_control',
					'saccha_nav_active_color_control',
					'saccha_nav_text_hover_color_control',
					'saccha_nav_text_active_color_control',
					'saccha_nav_sub_text_color_control',
					'saccha_nav_sub_text_hover_color_control',
					'saccha_nav_sub_text_active_color_control',
					'saccha_nav_sub_bg_color_control',
					'saccha_nav_sub_bg_hover_color_control',
					'saccha_nav_sub_bg_active_color_control'
				),
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_text_color_control',
		array(
			'default'           => $defaults['saccha_nav_text_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_text_color_control',
			array(
				'label'    => esc_html__( 'Text Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_text_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_hover_color_control',
		array(
			'default'           => $defaults['saccha_nav_hover_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_hover_color_control',
			array(
				'label'    => esc_html__( 'Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_hover_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_active_color_control',
		array(
			'default'           => $defaults['saccha_nav_active_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_active_color_control',
			array(
				'label'    => esc_html__( 'Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_active_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_text_hover_color_control',
		array(
			'default'           => $defaults['saccha_nav_text_hover_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_text_hover_color_control',
			array(
				'label'    => esc_html__( 'Text Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_text_hover_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_text_active_color_control',
		array(
			'default'           => $defaults['saccha_nav_text_active_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_text_active_color_control',
			array(
				'label'    => esc_html__( 'Text Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_text_active_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_sub_text_color_control',
		array(
			'default'           => $defaults['saccha_nav_sub_text_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_sub_text_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Text Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_sub_text_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_sub_text_hover_color_control',
		array(
			'default'           => $defaults['saccha_nav_sub_text_hover_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_sub_text_hover_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Text Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_sub_text_hover_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_sub_text_active_color_control',
		array(
			'default'           => $defaults['saccha_nav_sub_text_active_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_sub_text_active_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Text Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_sub_text_active_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_sub_bg_color_control',
		array(
			'default'           => $defaults['saccha_nav_sub_bg_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_sub_bg_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Background Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_sub_bg_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_sub_bg_hover_color_control',
		array(
			'default'           => $defaults['saccha_nav_sub_bg_hover_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_sub_bg_hover_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Background Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_sub_bg_hover_color_control',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'saccha_nav_sub_bg_active_color_control',
		array(
			'default'           => $defaults['saccha_nav_sub_bg_active_color_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'saccha_nav_sub_bg_active_color_control',
			array(
				'label'    => esc_html__( 'Sub Menu Background Active Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'saccha_nav_sub_bg_active_color_control',
				'priority' => 10,
			)
		)
	);


	/**
	 * Setting: Navigation Toggle
	 */
	$wp_customize->add_setting(
		'sacchaone_navigation_toggle_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'sacchaone_navigation_toggle_color',
			array(
				'label'      => esc_html__( 'Navigation Toggle', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_navigation_toggle_color',
				'toggle_ids' => array(
					'sacchaone_nav_toggle_open_icon_color',
					'sacchaone_nav_toggle_close_icon_color',
				),
			)
		)
	);

	$wp_customize->add_setting(
		'sacchaone_nav_toggle_open_icon_color',
		array(
			'default'           => $defaults['sacchaone_nav_toggle_open_icon_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sacchaone_nav_toggle_open_icon_color',
			array(
				'label'    => esc_html__( 'Open Icon Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'sacchaone_nav_toggle_open_icon_color',
				'priority' => 10,
			)
		)
	);
	
	$wp_customize->add_setting(
		'sacchaone_nav_toggle_close_icon_color',
		array(
			'default'           => $defaults['sacchaone_nav_toggle_close_icon_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sacchaone_nav_toggle_close_icon_color',
			array(
				'label'    => esc_html__( 'Close Icon Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'sacchaone_nav_toggle_close_icon_color',
				'priority' => 10,
			)
		)
	);
	
	/**
	 * Setting: Back to Top
	 */
	$wp_customize->add_setting(
		'sacchaone_back2top_colors',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'sacchaone_back2top_colors',
			array(
				'label'      => esc_html__( 'Back to Top', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_back2top_colors',
				'toggle_ids' => array(
					'sacchaone_back2top_icon_color',
					'sacchaone_back2top_icon_h_color',
					'sacchaone_back2top_bg_color',
					'sacchaone_back2top_bg_h_color'
				),
			)
		)
	);

	// $wp_customize->add_setting(
	// 	'sacchaone_back2top_icon_color',
	// 	array(
	// 		'default'           => $defaults['body_link_color'],
	// 		'transport'         => 'postMessage',
	// 		'sanitize_callback' => 'sanitize_hex_color',
	// 	)
	// );

	// $wp_customize->add_control(
	// 	new WP_Customize_Color_Control(
	// 		$wp_customize,
	// 		'sacchaone_back2top_icon_color',
	// 		array(
	// 			'label'    => esc_html__( 'Icon Color', 'sacchaone' ),
	// 			'section'  => 'colors',
	// 			'settings' => 'sacchaone_back2top_icon_color',
	// 			'priority' => 10,
	// 		)
	// 	)
	// );

	// $wp_customize->add_setting(
	// 	'sacchaone_back2top_icon_h_color',
	// 	array(
	// 		'default'           => $defaults['default_bg_color'],
	// 		'transport'         => 'postMessage',
	// 		'sanitize_callback' => 'sanitize_hex_color',
	// 	)
	// );

	// $wp_customize->add_control(
	// 	new WP_Customize_Color_Control(
	// 		$wp_customize,
	// 		'sacchaone_back2top_icon_h_color',
	// 		array(
	// 			'label'    => esc_html__( 'Icon Hover Color', 'sacchaone' ),
	// 			'section'  => 'colors',
	// 			'settings' => 'sacchaone_back2top_icon_h_color',
	// 			'priority' => 10,
	// 		)
	// 	)
	// );
	
	// $wp_customize->add_setting(
	// 	'sacchaone_back2top_bg_color',
	// 	array(
	// 		'default'           => $defaults['default_bg_color'],
	// 		'transport'         => 'postMessage',
	// 		'sanitize_callback' => 'sanitize_hex_color',
	// 	)
	// );

	// $wp_customize->add_control(
	// 	new WP_Customize_Color_Control(
	// 		$wp_customize,
	// 		'sacchaone_back2top_bg_color',
	// 		array(
	// 			'label'    => esc_html__( 'Background Color', 'sacchaone' ),
	// 			'section'  => 'colors',
	// 			'settings' => 'sacchaone_back2top_bg_color',
	// 			'priority' => 10,
	// 		)
	// 	)
	// );

	// $wp_customize->add_setting(
	// 	'sacchaone_back2top_bg_h_color',
	// 	array(
	// 		'default'           => $defaults['body_link_color'],
	// 		'transport'         => 'postMessage',
	// 		'sanitize_callback' => 'sanitize_hex_color',
	// 	)
	// );

	// $wp_customize->add_control(
	// 	new WP_Customize_Color_Control(
	// 		$wp_customize,
	// 		'sacchaone_back2top_bg_h_color',
	// 		array(
	// 			'label'    => esc_html__( 'Background Hover Color', 'sacchaone' ),
	// 			'section'  => 'colors',
	// 			'settings' => 'sacchaone_back2top_bg_h_color',
	// 			'priority' => 10,
	// 		)
	// 	)
	// );
	
	

	/**
	 * Setting: Buttons
	 */
	$wp_customize->add_setting(
		'sacchaone_buttons_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new SacchaOne_Separator_Control(
			$wp_customize,
			'sacchaone_buttons_color_control',
			array(
				'label'      => esc_html__( 'Buttons', 'sacchaone' ),
				'section'    => 'colors',
				'settings'   => 'sacchaone_buttons_color',
				'toggle_ids' => array(
					'button_bg_color_control',
					'button_bg_hover_color_control',
					'button_text_color_control',
					'button_text_hover_color_control',
					'button_border_color_control',
					'button_border_hover_color_control',
				),
			)
		)
	);

	/**
	 * Button background color
	 */
	$wp_customize->add_setting(
		'button_bg_color',
		array(
			'default'           => $defaults['button_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_bg_color_control',
			array(
				'label'    => esc_html__( 'Background Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'button_bg_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Button background hover color
	 */
	$wp_customize->add_setting(
		'button_bg_hover_color',
		array(
			'default'           => $defaults['button_bg_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_bg_hover_color_control',
			array(
				'label'    => esc_html__( 'Background Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'button_bg_hover_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Button text color
	 */
	$wp_customize->add_setting(
		'button_text_color',
		array(
			'default'           => $defaults['button_text_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_text_color_control',
			array(
				'label'    => esc_html__( 'Text Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'button_text_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Button text hover color
	 */
	$wp_customize->add_setting(
		'button_text_hover_color',
		array(
			'default'           => $defaults['button_text_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_text_hover_color_control',
			array(
				'label'    => esc_html__( 'Text Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'button_text_hover_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Button text hover color
	 */
	$wp_customize->add_setting(
		'button_border_color',
		array(
			'default'           => $defaults['button_border_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_border_color_control',
			array(
				'label'    => esc_html__( 'Border Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'button_border_color',
				'priority' => 10,
			)
		)
	);

	/**
	 * Button text hover color
	 */
	$wp_customize->add_setting(
		'button_border_hover_color',
		array(
			'default'           => $defaults['button_border_hover_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_border_hover_color_control',
			array(
				'label'    => esc_html__( 'Border Hover Color', 'sacchaone' ),
				'section'  => 'colors',
				'settings' => 'button_border_hover_color',
				'priority' => 10,
			)
		)
	);

	/**
	* Social Icon Panel
	*/
	$wp_customize->add_panel(
		'sacchaone_icon_panel',
		array(
			'priority'       =>50,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'    		 => esc_html__( 'Social Icons', 'sacchaone' ),
		)
	);

	/**
	* Social Icon Section
	*/
	$wp_customize->add_section(
		'sacchaone_icon_section',
		array(
			'title'    		=> esc_html__( 'Social Icons', 'sacchaone' ),
			'description'   => esc_html__( 'Add social media account links to apply social icons on the site footer.', 'sacchaone' ),
			'panel'         => 'sacchaone_icon_panel'
		)
	);

	/**
	* Social Media Section -->Facebook
	*/
	$wp_customize->add_setting( 'sacchaone_social_icon[facebook]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[facebook]',
		array(
			'label'=> 'Facebook',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[facebook]',
		)
	);
	/**
	 * Twitter Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[twitter]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[twitter]',
		array(
			'label'=> 'Twitter',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[twitter]',
		)
	);

	/**
	 * Instagrm Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[instagram]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[instagram]',
		array(
			'label'=> 'Instagram',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[instagram]',
		)
	);

	/**
	 * Linkedin Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[linkedin]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[linkedin]',
		array(
			'label'=> 'Linkedin',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[linkedin]',
		)
	);

	/**
	 * Amazon Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[amazon]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[amazon]',
		array(
			'label'=> 'Amazon',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[amazon]',
		)
	);

	/**
	 * Pinterest Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[pinterest]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[pinterest]',
		array(
			'label'=> 'Pinterest',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[pinterest]',
		)
	);

	/**
	 * Youtube Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[youtube]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[youtube]',
		array(
			'label'=> 'Youtube',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[youtube]',
		)
	);

	/**
	 * Spotify Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[spotify]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[spotify]',
		array(
			'label'=> 'Spotify',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[spotify]',
		)
	);

	/**
	 * Github Icon Section
	 */
	$wp_customize->add_setting( 'sacchaone_social_icon[github]' );
	$wp_customize->add_control(
		'sacchaone_social_icon[github]',
		array(
			'label'=> 'Github',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[github]',
		)
	);

	/**
	 * Tiktok Icon Section
	 */
	$wp_customize->add_setting(
		'sacchaone_social_icon[tiktok]',
		array(
			'default'=> '',
		)
	);
	$wp_customize->add_control(
		'sacchaone_social_icon[tiktok]',
		array(
			'label'=> 'Tiktok',
			'section'=> 'sacchaone_icon_section',
			'setting'=> 'sacchaone_social_icon[tiktok]',
		)
	);

	/**
	* Social Icons Setting Option
	*/
	$wp_customize->add_section(
		'sacchaone_icon_setting_section',
		array(
			'title'    		=> esc_html__( 'Settings', 'sacchaone' ),
			'description'    		=> esc_html__( 'You can enable social media icons and set icons size, icons color as well as icons hover.', 'sacchaone' ),
			'panel'         => 'sacchaone_icon_panel'
		)
	);

	/**
	 * Setting: for Social Media Icons
	 */
	$wp_customize->add_setting(
		'sacchaone_social_icons',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_social_icons'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sacchaone_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'sacchaone_social_icons',
		array(
			'label'    => esc_html__( 'Social Icons', 'sacchaone' ),
			'section'  => 'sacchaone_icon_setting_section',
			'settings' => 'sacchaone_social_icons',
			'type'     => 'select',
			'choices'  => array(
				1 => esc_html__( 'Enable', 'sacchaone' ),
				0 => esc_html__( 'Disable', 'sacchaone' ),
			),
		)
	);

	/**
	 * Setting: for Icon size
	 */
	$wp_customize->add_setting(
		'sacchaone_social_icon_size',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['sacchaone_social_icon_size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	/**
	 * Control: Icon size
	 */
	$wp_customize->add_control(
		'sacchaone_social_icon_size',
		array(
			'label'    => esc_html__( 'Icon Size', 'sacchaone' ),
			'description' => esc_html__( 'Measurement is in pixel.', 'sacchaone' ),
			'section'  => 'sacchaone_icon_setting_section',
			'settings' => 'sacchaone_social_icon_size',
			'type'     => 'number',
			'input_attrs' => array(
				'min' => 16,
				'max' => 100,
			),
		)
	);
	
	/**
	* Icon Color under setting Section
	*/

	$wp_customize->add_setting(
		'sacchaone_icon_color_setting',
		array(
			'default'       	=> $defaults['sacchaone_icon_color_setting'],
			'transport'     	=> 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'icon_color', 
			array(
				'label'      => esc_html__( 'Icon Color', 'sacchaone' ),
				'section'    => 'sacchaone_icon_setting_section',
				'settings'   => 'sacchaone_icon_color_setting',
			)
		) 
	);

	/**
	* Icon Hover Color under setting Section
	*/
	$wp_customize->add_setting(
		'sacchaone_icon_hover_color_setting',
		array(
			'transport'     	=> 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'icon_hover_color', 
			array(
				'label'      => esc_html__( 'Icon Hover Color', 'sacchaone' ),
				'section'    => 'sacchaone_icon_setting_section',
				'settings'   => 'sacchaone_icon_hover_color_setting',
			)
		) 
	);
}
add_action( 'customize_register', 'sacchaone_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sacchaone_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sacchaone_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sacchaone_customize_preview_js() {
	wp_enqueue_script( 'sacchaone-customizer', get_template_directory_uri() . '/assets/js/customizer/customizer.js', array( 'customize-preview' ), _SACCHAONE_VERSION, true );
}
add_action( 'customize_preview_init', 'sacchaone_customize_preview_js' );

add_action( 'wp_enqueue_scripts', 'sacchaone_inline_styles' );
/**
 * Adding dynamic inline CSS.
 */
function sacchaone_inline_styles() {
	$custom_css = sacchaone_get_dynamic_css();
	wp_add_inline_style( 'sacchaone-main-style', wp_strip_all_tags( $custom_css ) );
}


