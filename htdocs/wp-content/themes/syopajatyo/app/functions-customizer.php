<?php
/**
 * Filter functions.
 *
 * This file holds functions that are used for filtering.
 *
 * @package   Syopajatyo
 */

namespace Syopajatyo;

/**
 * Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function customize_register( $wp_customize ) {
	// Add the front-page-featured-featured section.
	$wp_customize->add_section(
		'front-page-featured',
		[
			'title'    => esc_html__( 'Front Page Featured Area', 'syopajatyo' ),
			'priority' => 10,
		]
	);

	// Loop same setting couple of times.
	$k = 1;

	while ( $k <= 3 ) {
		// Add the 'featured_category_*' setting.
		$wp_customize->add_setting(
			'featured_category_' . $k,
			[
				'default'           => 0,
				'sanitize_callback' => 'absint',
			]
		);
		// Add the 'featured_page_*' control.
		$wp_customize->add_control(
			'featured_category_' . $k,
			[
				/* Translators: %s stands for number. For example Select category 1. */
				'label'    => sprintf( esc_html__( 'Select category %s', 'syopajatyo' ), $k ),
				'section'  => 'front-page-featured',
				'type'     => 'hybrid-dropdown-terms',
				'priority' => $k + 1,
			]
		);

		$k++; // Add one before loop ends.
	} // End while loop.

	// Loop same setting couple of times.
	$k = 1;

	while ( $k <= 9 ) {
		// Add the 'featured_page_*' setting.
		$wp_customize->add_setting(
			'featured_page_' . $k,
			[
				'default'           => 0,
				'sanitize_callback' => 'absint',
			]
		);
		// Add the 'featured_page_*' control.
		$wp_customize->add_control(
			'featured_page_' . $k,
			[
				/* Translators: %s stands for number. For example Select page 1. */
				'label'    => sprintf( esc_html__( 'Select page %s', 'syopajatyo' ), $k ),
				'section'  => 'front-page-featured',
				'type'     => 'dropdown-pages',
				'priority' => $k + 20,
			]
		);

		$k++; // Add one before loop ends.
	} // End while loop.

}
add_action( 'customize_register', __NAMESPACE__ . '\customize_register' );

/**
 * Returns featured pages selected from the Customizer.
 *
 * @since  1.0.0
 *
 * @return array
 */
function featured_pages() {
	$k = 1;

	// Set empty array of featured pages.
	$syopajatyo_featured_pages = [];

	// Loop all the featured pages.
	while ( $k <= 9 ) { // Begins the loop through found pages from customize settings.
		$syopajatyo_page_id = absint( get_theme_mod( 'featured_page_' . $k ) );

		// Add selected featured pages in array.
		if ( 0 !== $syopajatyo_page_id || ! empty( $syopajatyo_page_id ) ) { // Check if page is selected.
			$syopajatyo_featured_pages[] = $syopajatyo_page_id;
		}

		$k++;
	}

	// Return featured pages.
	return $syopajatyo_featured_pages;
}
