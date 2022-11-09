<?php
/**
 * WordPress Customizer Range Controller
 *
 * @link https://w3guy.com/wordpress-customizer-range-control-selected-indicator/
 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 * @package SacchaOne
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'SacchaOne_Range_Control' ) ) {
	/**
	 * WP Customize Range Control
	 *
	 * @package SacchaOne
	 */
	class SacchaOne_Range_Control extends WP_Customize_Control {

		// @codingStandardsIgnoreStart
		public $type = 'custom_range';
		public function enqueue() {
			wp_enqueue_style(
				'sacchaone-range-control',
				SACCHAONE_THEME_URI . '/assets/css/customizer/range-control.css',
				'',
				_SACCHAONE_VERSION,
				'all'
			);
			wp_enqueue_script(
				'sacchaone-range-control-js',
				SACCHAONE_THEME_URI . '/assets/js/customizer/range-control.js',
				array( 'jquery' ),
				_SACCHAONE_VERSION,
				true
			);
			$data = array(
				'range_control_default' => '1200'
			);
			wp_localize_script( 'sacchaone-range-control-js', 'SACCHAONE_CUSTOMIZE_DATA', $data );
		}
		public function render_content() {
			?>
			<div class="sacchaone-range-control">
				<div class="sacchaone-range-title-area">
				<?php if ( ! empty( $this->label ) ) : ?>
					<label for="sacchaone-range-input">
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					</label>
					<span class="sacchaone-reset-range-control"><span class="dashicons dashicons-image-rotate"></span></span>
				<?php endif; ?>
				</div>
				<div class="sacchaone-range-slider-area">
					<div class="sacchaone-input-wrapper">
						<input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
						<input data-input-type="number" type="number" id="sacchaone-range-input" class="sacchaone-range-input" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
					</div>
					<?php if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>

				</div>
			
			</div>
			<?php
		}
	}
}
