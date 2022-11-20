<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package Syopajatyo
 */

namespace Syopajatyo;

/**
 * Enqueue js/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	// Main scripts.
	//wp_enqueue_script( 'syopajatyo-app', asset( 'js/app.js' ), null, null, true );

	wp_enqueue_script(
        'syopajatyo-app',
        get_theme_file_uri( 'dist/js/app.js' ),
        [],
        filemtime( get_theme_file_path( 'dist/js/app.js' ) )
    );

	// Add SVG icon which we can use via JS.
	wp_localize_script( 'syopajatyo-app', 'SyopaJaTyoText', array(
		'icon' => get_svg( array( 'icon' => 'angle-down' ) ),
	) );

	// Add custom fonts.
	wp_enqueue_style( 'syopajatyo-fonts', fonts_url(), null, null );

	// Main styles.
	//wp_enqueue_style( 'syopajatyo-style', asset( 'css/style.css' ), null, null );

	wp_enqueue_style(
        'syopajatyo-style',
        get_theme_file_uri( 'dist/css/style.css' ),
        [],
        filemtime( get_theme_file_path( 'dist/css/style.css' ) )
    );

	// Comments JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Dequeue Core block styles.
	wp_dequeue_style( 'wp-block-library' );
}, 10 );

/**
 * Enqueue editor js/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'enqueue_block_editor_assets', function() {
	// Main block styles.
	// wp_enqueue_style( 'syopajatyo-blocks', asset( 'css/editor.css' ), null, null );

	wp_enqueue_style(
        'syopajatyo-blocks',
        get_theme_file_uri( 'dist/css/editor.css' ),
        [],
        filemtime( get_theme_file_path( 'dist/css/editor.css' ) )
    );

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
