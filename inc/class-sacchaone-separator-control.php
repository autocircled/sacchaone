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

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'SacchaOne_Custom_Control' ) ) {
	/**
	 * WP Customize Range Control
	 *
	 * @package SacchaOne
	 */
	class SacchaOne_Separator_Control extends WP_Customize_Control {

		// @codingStandardsIgnoreStart
		public $type = 'sacchaone_separator';
		public $toggle_ids = [];
		public function enqueue() {
			wp_enqueue_style(
				'sacchaone-separator-control',
				SACCHAONE_THEME_DIR . 'assets/css/customizer/custom-separator.css',
				'',
				_SACCHAONE_VERSION,
				'all'
			);
			wp_enqueue_script(
				'sacchaone-separator-control-js',
				SACCHAONE_THEME_DIR . 'assets/js/customizer/custom-separator.js',
				array( 'jquery' ),
				_SACCHAONE_VERSION,
				true
			);
		}

		public function render_content() {
			?>
			<div class="sacchaone-separator-control">
				<div class="sacchaone-separator-title-area">
				<?php if ( ! empty( $this->label ) ) : ?>
					<label for="sacchaone-separator-input" class="toggle-text">
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					</label>
					<span class="sacchaone-toggle-control" target_ids="<?php echo esc_attr( implode(" ", $this->toggle_ids ) ); ?>"><span class="dashicons dashicons-arrow-right-alt2"></span></span>
				<?php endif; ?>
				</div>
				<div class="sacchaone-separator-content-area">
					<?php if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>

				</div>
			
			</div>
			<?php
		}
	}
}
