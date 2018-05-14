<?php
/**
 * Fonts related functions.
 *
 * @package Syopajatyo
 */

namespace Syopajatyo;

/**
 * Register custom fonts.
 */
function fonts_url() {
	$fonts_url = '';
	$fonts     = [];
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Titillium Web, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	if ( 'off' !== esc_attr_x( 'on', 'Titillium Web font: on or off', 'syopajatyo' ) ) {
		$fonts[] = 'Titillium Web:200,300,400,600,400i,600i';
	}

	if ( $fonts ) {
		$query_args = [
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		];

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array $urls          URLs to print for resource hints.
 */
function resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'syopajatyo-style', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = [
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		];
	}

	return $urls;
}
add_filter( 'wp_resource_hints', __NAMESPACE__ . '\\resource_hints', 10, 2 );
