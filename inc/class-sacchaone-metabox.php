<?php
/**
 * Meta box generator
 *
 * @package SacchaOne
 * @since 1.0.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'SacchaOne_Metabox' ) ) {
	/**
	 * Creates minified css via PHP.
	 *
	 * @author  Carlos Rios
	 * @link https://github.com/CarlosRios/php-css
	 * Modified by autocircle
	 */
	class SacchaOne_Metabox {

		public function init() {
			add_action( 'add_meta_boxes', [ $this, 'action_add_meta_boxes' ], 10, 2  );
			add_action( 'save_post', [ $this, 'save_meta_box' ] );
		}

		/**
		 * Fires after all built-in meta boxes have been added.
		 *
		 * @param string   $post_type Post type.
		 * @param \WP_Post $post      Post object.
		 */
		public function action_add_meta_boxes(string $post_type, \WP_Post $post) : void {
			add_meta_box( 'saccha-metabox-1', __( 'Additional Settings', 'sss' ), [ $this, 'saccha_metabox_1_callback' ] );
		}

		/**
		 * Meta box display callback.
		 *
		 * @param WP_Post $post Current post object.
		 */
		public function saccha_metabox_1_callback( $post ) {
			// ob_start();
			
			?>
			<div class="saccha-inner-settings">
				<?php
				$s_framework = new Sacchaone_Framework();
				$s_framework->add_field(
					'additional_settings',
					array(
						'label' => __( 'Enable Additional Settings?', 'sss' ),
						'type'  => 'radio',
						'default' => 'no',
						'choices' => array(
							'yes' => __( 'Enable', 'sss' ),
							'no'  => __( 'Disable', 'sss' ),
						),
					)
				);
				$s_framework->add_field(
					'transparent_page_header',
					array(
						'label' => __( 'Transparent Header', 'sss' ),
						'type'  => 'radio',
						'default' => 'no',
						'choices' => array(
							'yes' => __( 'Enable', 'sss' ),
							'no'  => __( 'Disable', 'sss' ),
						),
					)
				);
				$s_framework->add_field(
					'sidebar_type',
					array(
						'label' => __( 'Sidebar Type', 'sss' ),
						'type'  => 'radio',
						'default' => 'right',
						'choices' => array(
							'none' => __( 'None', 'sss' ),
							'left' => __( 'Left', 'sss' ),
							'right'  => __( 'Right', 'sss' ),
							'both'  => __( 'Both', 'sss' ),
						),
					)
				);
				?>
			</div>
			<?php
			// $form = ob_get_clean();
			// echo $form;
			
		}

		/**
		 * Save meta box content.
		 *
		 * @param int $post_id Post ID
		 */
		public function save_meta_box( $post_id ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
			if ( $parent_id = wp_is_post_revision( $post_id ) ) {
				$post_id = $parent_id;
			}
				
			$fields = [
				'additional_settings',
				'transparent_page_header',
				'sidebar_type',
			];
			foreach ( $fields as $field ) {
				if ( array_key_exists( $field, $_POST ) ) {
					update_post_meta( $post_id, SACCHAONE_PREFIX . $field, sanitize_text_field( $_POST[$field] ) );
				}
			}
		}
	}
}

$metabox = new SacchaOne_Metabox;
$metabox->init();
