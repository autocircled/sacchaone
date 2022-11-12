<?php
/**
 * Number sanitization callback
 *
 * @since 1.0.9
 */
function sacchaone_sanitize_number( $val ) {
	return is_numeric( $val ) ? $val : 0;
}

/**
 * Number with blank value sanitization callback
 *
 * @since 1.0.9
 */
function sacchaone_sanitize_number_blank( $val ) {
	return is_numeric( $val ) ? $val : '';
}