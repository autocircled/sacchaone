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
            add_action( 'wp_enqueue_scripts', array( $this, 'load_fonts' ) );

            // CSS output
			if ( is_customize_preview() ) {
				add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
				add_action( 'wp_head', array( $this, 'live_preview_styles' ), 999 );
			} else {
				add_filter( 'ocean_head_css', array( $this, 'head_css' ), 99 );
			}
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
                    'title'    => esc_html__( 'Typography', 'sacchaone' ),
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
                                'label'  	  => esc_html__( 'Font Family','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_font_family_' . $key,
                                'type'		  => 'select',
                                'choices'     => array(
                                        'default' 		=> esc_html__( 'Default','sacchaone'),
                                        'arial-helvet' 	=> esc_html__( 'Arial, Helvetica, sans-serif','sacchaone'),
                                        'arial-black' 	=> esc_html__( 'Arial Black, Gadget, sans-serif','sacchaone'),
                                        'bookman' 		=> esc_html__( 'Bookman Old Style, serif','sacchaone'),
                                        'comic-sans' 	=> esc_html__( 'Comic Sans MS, cursive','sacchaone'),
                                        'courier' 		=> esc_html__( 'Courier, monospace','sacchaone'),
                                        'georgia' 		=> esc_html__( 'Georgia, serif','sacchaone'),
                                        'impact'		=> esc_html__( 'Impact, Charcoal, sans-serif','sacchaone'),
                                        'lucida' 		=> esc_html__( 'Lucida Console, Monaco, monospace','sacchaone'),
                                        'tahoma' 		=> esc_html__( 'Tahoma, Geneva, sans-serif','sacchaone'),
                                        'Times' 		=> esc_html__( 'Times New Roman, Times, serif','sacchaone'),
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
                                'label'  	  => esc_html__( 'Font Weight','sacchaone'),
                                'description' => esc_html__( 'Important: Not all fonts support every font-weight.','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typography_weight_' . $key,
                                'type'		  => 'select',
                                'choices'     => array(
                                        'default' 		=> esc_html__( 'Default','sacchaone'),
                                        'thin' 			=> esc_html__( 'Thin : 100','sacchaone'),
                                        'light' 		=> esc_html__( 'Light : 200','sacchaone'),
                                        'book' 			=> esc_html__( 'Book : 300','sacchaone'),
                                        'normal' 		=> esc_html__( 'Normal : 400','sacchaone'),
                                        'medium' 		=> esc_html__( 'Medium : 500','sacchaone'),
                                        'semibold' 		=> esc_html__( 'Semibold : 600','sacchaone'),
                                        'bold'			=> esc_html__( 'Bold : 700','sacchaone'),
                                        'extrabold' 	=> esc_html__( 'Extra Bold : 800','sacchaone'),
                                        'black' 		=> esc_html__( 'Black: 800','sacchaone'),
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
                                'label'  	  => esc_html__( 'Font Style','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_font_style_' . $key,
                                'type'		  => 'select',
                                'choices'     => array(
                                        'default' 		=> esc_html__( 'Default','sacchaone'),
                                        'normal' 		=> esc_html__( 'Normal','sacchaone'),
                                        'italic' 		=> esc_html__( 'Italic','sacchaone'),
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
                                'label'  	  => esc_html__( 'Text Transform','sacchaone'),
                                'section'	  => 'sacchaone_typography_section_' . $key,
                                'setting'	  => 'sacchaone_typo_text_transform_' . $key,
                                'type'		  => 'select',
                                'choices'     => array(
                                        'default' 		=> esc_html__( 'Default','sacchaone'),
                                        'capitalize' 	=> esc_html__( 'Capitalize','sacchaone'),
                                        'lowercase' 	=> esc_html__( 'Lowercase','sacchaone'),
                                        'uppercase' 	=> esc_html__( 'Uppercase','sacchaone'),
                                        'none' 			=> esc_html__( 'None','sacchaone'),
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
                                'label'  	  => esc_html__( 'Font Size','sacchaone'),
                                'description' => esc_html__( 'You can add: px-em-%','sacchaone'),
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
                            $key . '_typography[line-height]',
                            array(
                                'type'              => 'theme_mod',
                                'sanitize_callback' => 'sacchaone_sanitize_number',
                                'transport'         => $transport,
                                'default'           => $default,
                            )
                        );
                        
                        $wp_customize->add_setting(
                            $key . '_tablet_typography[line-height]',
                            array(
                                'sanitize_callback' => 'sacchaone_sanitize_number_blank',
                                'transport'         => $transport,
                            )
                        );
                        
                        $wp_customize->add_setting(
                            $key . '_mobile_typography[line-height]',
                            array(
                                'sanitize_callback' => 'sacchaone_sanitize_number_blank',
                                'transport'         => $transport,
                            )
                        );

                        $wp_customize->add_control(
                            new SacchaOne_Customizer_Slider_Control(
                                $wp_customize,
                                $key . '_typography[line-height]',
                                array(
                                    'label'  	  => esc_html__( 'Line Height (px)','sacchaone'),
                                    'section'	  => 'sacchaone_typography_section_' . $key,
                                    // 'settings'        => array(
                                    //     'desktop' => $key . '_typography[line-height]',
                                    //     'tablet'  => $key . '_tablet_typography[line-height]',
                                    //     'mobile'  => $key . '_mobile_typography[line-height]',
                                    // ),
                                    'priority'        => 10,
                                    'active_callback' => $active_callback,
                                    'input_attrs'     => array(
                                        'min'  => 0,
                                        'max'  => 4,
                                        'step' => 0.1,
                                    ),
                                )
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
                                'label'  	  => esc_html__( 'Letter Spacing (px)','sacchaone'),
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
                                    'label'  	  => esc_html__( 'Font Color','sacchaone'),
                                    'section'  => 'sacchaone_typography_section_' . $key,
                                    'settings' => 'setting_for_font_color_' . $key,
                                )
                            )
                        );
                    }
                }
            }
            
        }

        /**
		 * Loads js file for customizer preview
		 *
		 * @since 1.0.9
		 */
		public function customize_preview_init() {
			// wp_enqueue_script( 'sacchaone-typography-customize-preview', SACCHAONE_INC_DIR_URI . 'customizer/assets/js/typography-customize-preview.min.js', array( 'customize-preview' ), _SACCHAONE_VERSION, true );
			// wp_localize_script(
			// 	'sacchaone-typography-customize-preview',
			// 	'sacchaOneTG',
			// 	array(
			// 		'googleFontsUrl'    => '//fonts.googleapis.com',
			// 		'googleFontsWeight' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
			// 	)
			// );

		}

        /**
		 * Loop through settings
		 *
		 * @since 1.0.9
		 */
		public function loop( $return = 'css' ) {
            $css            = '';
			$fonts          = array();
			$elements       = self::elements();
			$preview_styles = array();

            // Loop through each elements that need typography styling applied to them
			foreach ( $elements as $element => $array ) {
                //var_dump($array);
                // Add empty css var
				$add_css    = '';
				$tablet_css = '';
				$mobile_css = '';

                // Get target and current mod
				// $target         = isset( $array['target'] ) ? $array['target'] : '';
				// $get_mod        = get_theme_mod( $element . '_typography' );
				// $tablet_get_mod = get_theme_mod( $element . '_tablet_typography' );
				// $mobile_get_mod = get_theme_mod( $element . '_mobile_typography' );
            }
        }

        /**
		 * Get CSS
		 *
		 * @since 1.0.9
		 */
		public function head_css( $output ) {

			// Get CSS
			$typography_css = self::loop( 'css' );

			// Loop css
			if ( $typography_css ) {
				$output .= $typography_css;
			}

			// Return output css
			return $output;

		}

        /**
		 * Returns correct CSS to output to wp_head
		 *
		 * @since 1.0.9
		 */
		public function live_preview_styles() {

			$live_preview_styles = []; //self::loop( 'preview_styles' );

			if ( $live_preview_styles ) {
				foreach ( $live_preview_styles as $key => $val ) {
					if ( ! empty( $val ) ) {
						echo '<style class="' . $key . '"> ' . $val . '</style>';
					}
				}
			}

		}

        /**
		 * Loads Google fonts
		 *
		 * @since 1.0.9
         * @todo create replica function of `oceanwp_enqueue_google_font`
		 */
		public function load_fonts() {

			// Get fonts
			$fonts = self::loop( 'fonts' );

			// Loop through and enqueue fonts
			if ( ! empty( $fonts ) && is_array( $fonts ) ) {
				foreach ( $fonts as $font ) {
					// oceanwp_enqueue_google_font( $font );
				}
			}

		}


    }
}


return new SacchaOne_Typography();