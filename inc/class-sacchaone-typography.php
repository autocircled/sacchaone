<?php
/**
 * Generate Typography Controls
 *
 * @package SacchaOne
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SacchaOne_Typography' ) ) {

    class SacchaOne_Typography {

        /**
		 * Setup class.
		 *
		 * @since 1.0.9
		 */
		public function __construct() {
            add_action( 'customize_register', array( $this, 'customizer_options' ) );
        }

        /**
		 * Array of Typography settings to add to the customizer
		 *
		 * @since 1.0.9
		 */
		public function elements() {

			// Return settings
			return apply_filters(
                'sacchaone_typography_settings',
                array(
                    'heading_h1'           => array(
                        'label'    => esc_html__( 'Heading 1 (H1)', 'sacchaone' ),
                        'target'   => 'h1',
                        'defaults' => array(
                            'font-size'   => '23px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'heading_h2'           => array(
                        'label'    => esc_html__( 'Heading 2 (H2)', 'sacchaone' ),
                        'target'   => 'h2',
                        'defaults' => array(
                            'font-size'   => '20px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'heading_h3'           => array(
                        'label'    => esc_html__( 'Heading 3 (H3)', 'sacchaone' ),
                        'target'   => 'h3',
                        'defaults' => array(
                            'font-size'   => '18px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'heading_h4'           => array(
                        'label'    => esc_html__( 'Heading 4 (H4)', 'sacchaone' ),
                        'target'   => 'h4',
                        'defaults' => array(
                            'font-size'   => '16px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                )
            );
        }

        /**
		 * Customizer options
		 *
		 * @since 1.0.0
		 */
		public function customizer_options( $wp_customize ) {

            // Get elements
			$elements = self::elements();

			// Return if elements are empty
			if ( empty( $elements ) ) {
				return;
			}

            /**
             * Panel: Typography
             */
            $wp_customize->add_panel(
                'sacchaone_typography',
                array(
                    'title'    => __( 'Typography', 'sacchaone' ),
                    'priority' => 60,
                )
            );

            // Loop
            foreach ( $elements as $key => $el ) {
                
                /**
                 * Section, under Typography Panel
                 */
                $wp_customize->add_section(
                    'sacchaone_typography_section_' . $key,
                    array(
                        'title'    => $el['label'],
                        'priority' => 70,
                        'panel'	   => 'sacchaone_typography',
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Font Family.
                 */
                $wp_customize->add_setting(
                    'sacchaone_typo_font_family_' . $key,
                    array(
                        'default'  =>'default',
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Font Family
                 */
                $wp_customize->add_control(
                    'sacchaone_typo_font_family_' . $key,
                    array(
                        'label'  	  => __('Font Family','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typo_font_family_' . $key,
                        'type'		  => 'select',
                        'choices'     => array(
                                'default' 		=> __('Default','sacchaone'),
                                'arial-helvet' 	=> __('Arial, Helvetica, sans-serif','sacchaone'),
                                'arial-black' 	=> __('Arial Black, Gadget, sans-serif','sacchaone'),
                                'bookman' 		=> __('Bookman Old Style, serif','sacchaone'),
                                'comic-sans' 	=> __('Comic Sans MS, cursive','sacchaone'),
                                'courier' 		=> __('Courier, monospace','sacchaone'),
                                'georgia' 		=> __('Georgia, serif','sacchaone'),
                                'impact'		=> __('Impact, Charcoal, sans-serif','sacchaone'),
                                'lucida' 		=> __('Lucida Console, Monaco, monospace','sacchaone'),
                                'tahoma' 		=> __('Tahoma, Geneva, sans-serif','sacchaone'),
                                'Times' 		=> __('Times New Roman, Times, serif','sacchaone'),
                        )
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Font Weight
                 */
                $wp_customize->add_setting(
                    'sacchaone_typography_setting_' . $key,
                    array(
                        'default'  =>'default',
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Font Weight
                 */
                $wp_customize->add_control(
                    'sacchaone_typography_setting_' . $key,
                    array(
                        'label'  	  => __('Font Weight','sacchaone'),
                        'description' => __('Important: Not all fonts support every font-weight.','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typography_setting_' . $key,
                        'type'		  => 'select',
                        'choices'     => array(
                                'default' 		=> __('Default','sacchaone'),
                                'thin' 			=> __('Thin : 100','sacchaone'),
                                'light' 		=> __('Light : 200','sacchaone'),
                                'book' 			=> __('Book : 300','sacchaone'),
                                'normal' 		=> __('Normal : 400','sacchaone'),
                                'medium' 		=> __('Medium : 500','sacchaone'),
                                'semibold' 		=> __('Semibold : 600','sacchaone'),
                                'bold'			=> __('Bold : 700','sacchaone'),
                                'extrabold' 	=> __('Extra Bold : 800','sacchaone'),
                                'black' 		=> __('Black: 800','sacchaone'),
                        )
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Font Style
                 */
                $wp_customize->add_setting(
                    'sacchaone_typo_font_style_setting_' . $key,
                    array(
                        'default'  =>'default',
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Font Style
                 */
                $wp_customize->add_control(
                    'sacchaone_typo_font_style_setting_' . $key,
                    array(
                        'label'  	  => __('Font Style','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typo_font_style_setting_' . $key,
                        'type'		  => 'select',
                        'choices'     => array(
                                'default' 		=> __('Default','sacchaone'),
                                'normal' 		=> __('Normal','sacchaone'),
                                'italic' 		=> __('Italic','sacchaone'),
                        )
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Text Transform
                 */
                $wp_customize->add_setting(
                    'sacchaone_typo_text_transform_' . $key,
                    array(
                        'default'  =>'default',
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Text Transform
                 */
                $wp_customize->add_control(
                    'sacchaone_typo_text_transform_' . $key,
                    array(
                        'label'  	  => __('Text Transform','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typo_text_transform_' . $key,
                        'type'		  => 'select',
                        'choices'     => array(
                                'default' 		=> __('Default','sacchaone'),
                                'capitalize' 	=> __('Capitalize','sacchaone'),
                                'lowercase' 	=> __('Lowercase','sacchaone'),
                                'uppercase' 	=> __('Uppercase','sacchaone'),
                                'none' 			=> __('None','sacchaone'),
                        )
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Font Size
                */
                $wp_customize->add_setting(
                    'sacchaone_typo_font_size_' . $key,
                    array(
                        'default'  => $el['defaults']['font-size'],
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Font Size
                 */
                $wp_customize->add_control(
                    'sacchaone_typo_font_size_' . $key,
                    array(
                        'label'  	  => __('Font Size','sacchaone'),
                        'description' => __('You can add: px-em-%','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typo_font_size_' . $key,			
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Line Height
                */
                $wp_customize->add_setting(
                    'sacchaone_typo_line_height_' . $key,
                    array(
                        'default'  => $el['defaults']['line-height'],
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Line Height
                 */
                $wp_customize->add_control(
                    'sacchaone_typo_line_height_' . $key,
                    array(
                        'label'  	  => __('Line Height (px)','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typo_line_height_' . $key,			
                    )
                );

                /**
                 * Settings, under Typography ( Section : Heading 1 (H1) ) Letter Spacing
                */
                $wp_customize->add_setting(
                    'sacchaone_typo_letter_spacing_' . $key,
                    array(
                        'default'  => '0' .'px',
                    )
                );

                /**
                 * Control, under Typography ( Section : Heading 1 (H1) ) Letter Spacing
                 */
                $wp_customize->add_control(
                    'sacchaone_typo_letter_spacing_' . $key,
                    array(
                        'label'  	  => __('Letter Spacing (px)','sacchaone'),
                        'section'	  => 'sacchaone_typography_section_' . $key,
                        'setting'	  => 'sacchaone_typo_letter_spacing_' . $key,			
                    )
                );

                /**
                 * Font Color Setting & Control under Typography Heading 1 (H1) Section.
                 */
                $wp_customize->add_setting(
                    'setting_for_font_color_' . $key,
                    array(
                        'default'           => $el['defaults']['color'],
                        'transport'         => 'postMessage',
                        'sanitize_callback' => 'sanitize_hex_color',
                    )
                );

                $wp_customize->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customize,
                        'setting_for_font_color_' . $key,
                        array(
                            'label'  	  => __('Font Color','sacchaone'),
                            'section'  => 'sacchaone_typography_section_' . $key,
                            'settings' => 'setting_for_font_color_' . $key,
                        )
                    )
                );
            }
            
        }


    }
}


return new SacchaOne_Typography();