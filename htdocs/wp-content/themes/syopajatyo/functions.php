<?php
/**
 * Theme functions.
 *
 * This file is used to load the autoload and bootstrap files necessary
 * for kick-starting the theme.
 *
 * @package   Syopajatyo
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/samikeijonen/syopajatyo/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Load Hybrid Core.
if ( file_exists( get_parent_theme_file_path( 'hybrid-core/src/bootstrap-hybrid.php' ) ) ) {
	require_once get_parent_theme_file_path( 'hybrid-core/src/bootstrap-hybrid.php' );
}

// Bootstrap the theme. This loads any functions-files from the `/app` folder
// that are needed. If the theme needs a more robust bootstrapping process, it's
// recommended to create a `/bootstrap` folder and load those files directly.
array_map(
	function( $file ) {
		require_once get_parent_theme_file_path( "app/{$file}.php" );
	},
	[
		'functions-customizer',
		'functions-filters',
		'functions-fonts',
		'functions-helpers',
		'functions-svg',
		'functions-scripts',
		'functions-setup',
		'template-general',
	]
);
