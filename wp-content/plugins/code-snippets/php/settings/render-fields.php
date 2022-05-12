<?php

/**
 * This file handles rendering the settings fields
 *
 * @since 2.0.0
 * @package Code_Snippets
 */

/**
 * Render a checkbox field for a setting
 *
 * @since 2.0.0
 *
 * @param array $atts The setting field's attributes
 */
function code_snippets_checkbox_field( $atts ) {
	$saved_value = code_snippets_get_setting( $atts['section'], $atts['id'] );
	$input_name = sprintf( 'code_snippets_settings[%s][%s]', $atts['section'], $atts['id'] );

	if ( ! empty( $atts['label'] ) ) {
		printf( '<label for="%s">', esc_attr( $input_name ) );
	}

	printf(
		'<input type="checkbox" name="%s"%s>',
		esc_attr( $input_name ),
		checked( $saved_value, true, false )
	);

	if ( ! empty( $atts['label'] ) ) {
		echo esc_html( $atts['label'] ), '</label>';
	}

	// Add field description if it is set
	if ( ! empty( $atts['desc'] ) ) {
		echo '<p class="description">' . esc_html( $atts['desc'] ) . '</p>';
	}
}

/**
 * Render a number select field for an editor setting
 *
 * @since 2.0.0
 *
 * @param array $atts The setting field's attributes
 */
function code_snippets_number_field( $atts ) {

	printf(
		'<input type="number" name="code_snippets_settings[%s][%s]" value="%s"',
		esc_attr( $atts['section'] ),
		esc_attr( $atts['id'] ),
		esc_attr( code_snippets_get_setting( $atts['section'], $atts['id'] ) )
	);

	if ( isset( $atts['min'] ) ) {
		printf( ' min="%d"', esc_attr( $atts['min'] ) );
	}

	if ( isset( $atts['max'] ) ) {
		printf( ' max="%d"', esc_attr( $atts['max'] ) );
	}

	echo '>';

	if ( ! empty( $atts['label'] ) ) {
		echo ' ' . esc_html( $atts['label'] );
	}

	// Add field description if it is set
	if ( ! empty( $atts['desc'] ) ) {
		echo '<p class="description">' . esc_html( $atts['desc'] ) . '</p>';
	}
}
