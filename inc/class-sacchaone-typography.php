<?php
/**
 * Generate Typography Controls
 *
 * @since 1.0.9
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
                    'body' => array(
						'label'    => esc_html__( 'Body', 'sacchaone' ),
						'target'   => 'body',
						'defaults' => array(
							'font-size'   => '14px',
							'color'       => '#929292',
							'line-height' => '1.8',
						),
					),
                    // 'headings' => array(
					// 	'label'    => esc_html__( 'All Headings', 'sacchaone' ),
					// 	'target'   => 'h1,h2,h3,h4,h5,h6',
					// 	'exclude'  => array( 'font-size' ),
					// 	'defaults' => array(
					// 		'color'       => '#333333',
					// 		'line-height' => '1.4',
					// 	),
					// ),
                    'heading_h1' => array(
                        'label'    => esc_html__( 'Heading 1 (H1)', 'sacchaone' ),
                        'target'   => 'h1',
                        'defaults' => array(
                            'font-size'   => '23px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'heading_h2' => array(
                        'label'    => esc_html__( 'Heading 2 (H2)', 'sacchaone' ),
                        'target'   => 'h2',
                        'defaults' => array(
                            'font-size'   => '20px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'heading_h3' => array(
                        'label'    => esc_html__( 'Heading 3 (H3)', 'sacchaone' ),
                        'target'   => 'h3',
                        'defaults' => array(
                            'font-size'   => '18px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'heading_h4' => array(
                        'label'    => esc_html__( 'Heading 4 (H4)', 'sacchaone' ),
                        'target'   => 'h4',
                        'defaults' => array(
                            'font-size'   => '16px',
                            'color'       => '#333333',
                            'line-height' => '1.4',
                        ),
                    ),
                    'logo' => array(
						'label'    => esc_html__( 'Logo', 'sacchaone' ),
						'target'   => '#site-logo a.site-logo-text',
						'exclude'  => array( 'font-color' ),
						'defaults' => array(
							'font-size'   => '24px',
							'line-height' => '1.8',
						),
					),
                )
            );
        }

        /**
		 * Customizer options
		 *
		 * @since 1.0.9
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
            $count = '1';
            foreach ( $elements as $key => $el ) {
                $count++;

                $label              = ! empty( $el['label'] ) ? $el['label'] : null;
                $exclude_attributes = ! empty( $el['exclude'] ) ? $el['exclude'] : false;
                $active_callback    = isset( $el['active_callback'] ) ? $el['active_callback'] : null;
				$transport          = 'postMessage';

                // Get attributes
				if ( ! empty( $el['attributes'] ) ) {
					$attributes = $el['attributes'];
				} else {
					$attributes = array(
						'font-family',
						'font-weight',
						'font-style',
						'text-transform',
						'font-size',
						'line-height',
						'letter-spacing',
						'font-color',
					);
				}

                $attributes = array_combine( $attributes, $attributes );
                
                // Exclude attributes for specific options
				if ( $exclude_attributes ) {
					foreach ( $exclude_attributes as $key => $val ) {
						unset( $attributes[ $val ] );
					}
				}

                // Register new setting if label isn't empty
				if ( $label ) {
                
                    /**
                     * Section: Typography Elements
                     */
                    $wp_customize->add_section(
                        'sacchaone_typography_section_' . $key,
                        array(
                            'title'    => $label,
                            'priority' => $count,
                            'panel'	   => 'sacchaone_typography',
                        )
                    );

                    /**
                     * Font Family
                     */
                    if ( in_array( 'font-family', $attributes ) ) {

                        $wp_customize->add_setting(
                            'sacchaone_typo_font_family_' . $key,
                            array(
                                'default'  =>'default',
                            )
                        );

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
                    }

                    /**
                     * Font Weight
                     */
                    if ( in_array( 'font-weight', $attributes ) ) {

                        $wp_customize->add_setting(
                            'sacchaone_typography_weight_' . $key,
                            array(
                                'default'  =>'default',
                            )
                        );

                        $wp_customize->add_control(
                            'sacchaone_typography_weight_' . $key,
                            array(
                                'label'  	  => __('Font Weight','sacchaone'),
                                'description' => __('Important: Not all fonts support every font-weight.','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typography_weight_' . $key,
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
                    }

                    /**
                     * Font Style
                     */
                    if ( in_array( 'font-style', $attributes ) ) {

                        $wp_customize->add_setting(
                            'sacchaone_typo_font_style_' . $key,
                            array(
                                'default'  =>'default',
                            )
                        );

                        $wp_customize->add_control(
                            'sacchaone_typo_font_style_' . $key,
                            array(
                                'label'  	  => __('Font Style','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_font_style_' . $key,
                                'type'		  => 'select',
                                'choices'     => array(
                                        'default' 		=> __('Default','sacchaone'),
                                        'normal' 		=> __('Normal','sacchaone'),
                                        'italic' 		=> __('Italic','sacchaone'),
                                )
                            )
                        );
                    }

                    /**
                     * Text Transform
                     */
                    if ( in_array( 'text-transform', $attributes ) ) {
                        
                        $wp_customize->add_setting(
                            'sacchaone_typo_text_transform_' . $key,
                            array(
                                'default'  =>'default',
                            )
                        );

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
                    }

                    /**
                     * Font Size
                     */
                    if ( in_array( 'font-size', $attributes ) ) {

                        $default = ! empty( $el['defaults']['font-size'] ) ? $el['defaults']['font-size'] : null;

                        $wp_customize->add_setting(
                            'sacchaone_typo_font_size_' . $key,
                            array(
                                'default'  => $default,
                            )
                        );

                        $wp_customize->add_control(
                            'sacchaone_typo_font_size_' . $key,
                            array(
                                'label'  	  => __('Font Size','sacchaone'),
                                'description' => __('You can add: px-em-%','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_font_size_' . $key,			
                            )
                        );
                    }

                    /**
                     * Line Height
                     */
                    if ( in_array( 'line-height', $attributes ) ) {

                        $default = ! empty( $el['defaults']['line-height'] ) ? $el['defaults']['line-height'] : null;

                        $wp_customize->add_setting(
                            'sacchaone_typo_line_height_' . $key,
                            array(
                                'default'  => $default,
                            )
                        );

                        $wp_customize->add_control(
                            'sacchaone_typo_line_height_' . $key,
                            array(
                                'label'  	  => __('Line Height (px)','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_line_height_' . $key,			
                            )
                        );
                    }

                    /**
                     * Letter Spacing
                     */
                    if ( in_array( 'letter-spacing', $attributes ) ) {
                        
                        $default = ! empty( $el['defaults']['letter-spacing'] ) ? $el['defaults']['letter-spacing'] : null;

                        $wp_customize->add_setting(
                            'sacchaone_typo_letter_spacing_' . $key,
                            array(
                                'default'  => $default,
                            )
                        );

                        $wp_customize->add_control(
                            'sacchaone_typo_letter_spacing_' . $key,
                            array(
                                'label'  	  => __('Letter Spacing (px)','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_letter_spacing_' . $key,			
                            )
                        );
                    }

                    /**
                     * Font Color
                     */
                    if ( in_array( 'font-color', $attributes ) ) {
                        
                        $default = ! empty( $el['defaults']['color'] ) ? $el['defaults']['color'] : null;

                        $wp_customize->add_setting(
                            'setting_for_font_color_' . $key,
                            array(
                                'default'           => $default,
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


    }
}


return new SacchaOne_Typography();