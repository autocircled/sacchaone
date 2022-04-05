<?php
/**
 * Search form template
 *
 * @package SacchaOne
 * @since 1.0
 */

if ( $args['aria_label'] ) {
	$aria_label = 'aria-label="' . esc_attr( $args['aria_label'] ) . '" ';
} else {
	/*
	 * If there's no custom aria-label, we can set a default here. At the
	 * moment it's empty as there's uncertainty about what the default should be.
	 */
	$aria_label = '';
}

if ( isset( $args['location'] ) && ! empty( $args['location'] ) && 'navbar' === $args['location'] ) {
	?>
	<form role="search" <?php echo esc_attr( $aria_label ); ?> method="get" class="search-form modal-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<!-- <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'sacchaone' ); ?>" value="<?php echo get_search_query(); ?>" name="s" /> -->
		<label>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'sacchaone' ); ?></span>
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'sacchaone' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</label>
		<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sacchaone' ); ?>" />
	</form>
	<?php
} else {
	?>
	<form role="search" <?php echo esc_attr( $aria_label ); ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'sacchaone' ); ?></span>
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'sacchaone' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</label>
		<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sacchaone' ); ?>" />
	</form>
	<?php
}
