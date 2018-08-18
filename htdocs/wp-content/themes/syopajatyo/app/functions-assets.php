<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package Syopajatyo
 */

namespace Syopajatyo;

use Hybrid\app;

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	// Main scripts.
	wp_enqueue_script( 'syopajatyo-app', asset( 'scripts/app.js' ), null, null, true );

	// Add SVG icon which we can use via JS.
	wp_localize_script( 'syopajatyo-app', 'SyopaJaTyoText', array(
		'icon' => get_svg( array( 'icon' => 'angle-down' ) ),
	) );

	// Add custom fonts.
	wp_enqueue_style( 'syopajatyo-fonts', fonts_url(), null, null );

	// Main styles.
	wp_enqueue_style( 'syopajatyo-style', asset( 'styles/style.css' ), null, null );

	// Comments JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Dequeue Core block styles.
	wp_dequeue_style( 'wp-block-library' );
}, 10 );

/**
 * Enqueue editor scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'enqueue_block_editor_assets', function() {
	// Main block styles.
	wp_enqueue_style( 'syopajatyo-blocks', asset( 'styles/editor.css' ), null, null );

	// Unregister core block and theme styles.
	wp_deregister_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library-theme' );

	// Re-register core block and theme styles with an empty string. This is
	// necessary to get styles set up correctly.
	wp_register_style( 'wp-block-library', '' );
	wp_register_style( 'wp-block-library-theme', '' );
}, 10 );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0.0
 */
add_action( 'wp_head', function() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}, 0 );

/**
 * Helper function for outputting an asset URL in the theme. This integrates
 * with Laravel Mix for handling cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the filename.
 *
 * @link   https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 * @since  1.0.0
 * @access public
 * @param  string $path Path to assets.
 * @return string
 */
function asset( $path ) {
	// Get the Laravel Mix manifest.
	$manifest = App::resolve( 'syopajatyo/mix' );

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_theme_file_uri( 'dist' . $path );
}

/**
 * Returns the Laravel Mix manifest.
 *
 * Note that `file_get_contents()` is not allowed on WordPress.org. If building
 * a theme for the WP directory, you'll need to remove this function and the
 * reference to it in the `asset()` function.
 *
 * @link   https://github.com/WordPress/theme-check/issues/55
 * @link   https://wordpress.stackexchange.com/questions/166161/why-cant-the-wp-filesystem-api-read-googlefonts-json/166175
 *
 * @since  1.0.0
 * @access public
 * @return array|false
 */
function mix() {
	$manifest = app( 'syopajatyo/mix' );

	// If there is no manifest saved yet, let's see if we can find one.
	if ( ! $manifest ) {

		$file = get_theme_file_path( 'dist/mix-manifest.json' );

		if ( file_exists( $file ) ) {
			$manifest = json_decode( file_get_contents( $file ), true );

			if ( $manifest ) {
				app()->add( 'syopajatyo/mix', $manifest );
			}
		}
	}

	return $manifest;
}
