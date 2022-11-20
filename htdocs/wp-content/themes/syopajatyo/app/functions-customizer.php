<?php
/**
 * Customizer related functions.
 *
 * @package Syopajatyo
 */

namespace Syopajatyo;

/**
 * Adds actions on the appropriate customize action hooks.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'customize_register', function( $wp_customize ) {
	// Load DropdownTerms.
	require_once get_parent_theme_file_path( "app/class-customizer.php" );

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
		// Add the 'featured_category_*' control.
		$wp_customize->add_control(
			new DropdownTerms(
				$wp_customize,
				'featured_category_' . $k,
				$args = [
					/* Translators: %s stands for number. For example Select category 1. */
					'label'    => sprintf( esc_html__( 'Select category %s', 'syopajatyo' ), $k ),
					'section'  => 'front-page-featured',
					'type'     => 'hybrid-dropdown-terms',
					'priority' => $k + 1,
				]
			)
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
}, 10 );
