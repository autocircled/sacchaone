<?php
/**
 * SacchaOne Framework
 *
 * @package SacchaOne
 * @since 1.0.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sacchaone_Framework' ) ) {
	/**
	 * SacchaOne Framework
	 *
	 * @package SacchaOne
	 * @since 1.0.8
	 */
	class Sacchaone_Framework {
		/**
		 * Add fields by calling this method alogn with id
		 *
		 * @since 1.0.8
		 */
		public function add_field( $id, $args = array(), $priority = 10 ) {

			if ( $id ) {
				$this->render( $id, $args );
			} else {
				echo esc_html( __( 'Field ID is missing.', 'sss' ) );
			}
		}

		private function render( $id, $args ) {
			global $post;

			$args = wp_parse_args( $args, array(
				'label' => '',
				'type'  => '',
				'default' => '',
				'choices' => array()
			));
			$saved_value = '';
			if( ! empty( $id ) ) {
				$saved_value = get_post_meta( $post->ID, $id, true );
			}
			

			ob_start();
			?>
			<div id="sacchaone-<?php echo esc_attr( $id ); ?>">

				<label><?php echo esc_html( $args['label'] ); ?></label>

				<?php if ( count( $args['choices'] ) > 0 ) { ?>
					<div class="input-group">
						<ul>
							<?php foreach( $args['choices'] as $key => $label ) { ?>
								<li>
									<label for="<?php echo esc_attr( $id . '-' . $key ); ?>"><?php echo esc_html( $label ); ?></label>
									<input
										type="<?php echo esc_attr( $args['type'] ); ?>"
										name="<?php echo esc_attr( $id ); ?>"
										id="<?php echo esc_attr( $id . '-' . $key ); ?>"
										value="<?php echo esc_attr( $key ); ?>"
										<?php echo $saved_value && $saved_value === $key ? esc_attr( 'checked' ) : ''; ?>>
								</li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>

			</div>
			<?php
			$html = ob_get_clean();
			$data = array(
				'div' => array(
					'id' => array(),
					'class' => array(),
				),
				'ul' => array(
					'id' => array(),
					'class' => array(),
				),
				'li' => array(
					'id' => array(),
					'class' => array(),
				), 
				'label' => array(
					'for' => array(),
				),
				'input' => array(
					'type' => array(),
					'name' => array(),
					'id' => array(),
					'class' => array(),
					'value' => array(),
					'checked' => array(),
				),

			);
			echo wp_kses( $html, $data );
		}
	}
}
