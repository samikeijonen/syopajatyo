<?php
/**
 * Helper functions.
 *
 * This file holds basic helper functions used within the theme.
 *
 * @package Syopajatyo
 */

namespace Syopajatyo;

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
