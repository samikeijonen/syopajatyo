<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package    Syopajatyo
 */

namespace Syopajatyo;

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	// Main scripts.
	wp_enqueue_script( 'syopajatyo-app', asset( 'scripts/app.js' ), null, false, true );

	// Add SVG icon which we can use via JS.
	wp_localize_script( 'syopajatyo-app', 'SyopaJaTyoText', array(
		'icon' => get_svg( array( 'icon' => 'angle-down' ) ),
	) );

	// Add custom fonts.
	wp_enqueue_style( 'syopajatyo-fonts', fonts_url(), null, null );

	// Main styles.
	wp_enqueue_style( 'syopajatyo-style', asset( 'styles/style.css' ), null );

	// Comments JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Dequeue Core block styles.
	wp_dequeue_style( 'wp-core-blocks' );
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
	wp_enqueue_style( 'syopajatyo-blocks', asset( 'styles/editor.css' ), null );
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
 * Helper function for getting the script/style `.min` suffix for minified files.
 *
 * @return string
 */
function get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? '' : '.min';
}
