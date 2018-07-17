<?php
/**
 * Autoload bootstrap file.
 *
 * This file is used to autoload classes and functions necessary for the theme
 * to run.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Syopajatyo;

// ------------------------------------------------------------------------------
// Autoload classes.
// ------------------------------------------------------------------------------
//
// Register an autoloader for handling class loading. We're using Hybrid Core's
// built-in autoloader for simplicity. Class names should be in Pascal Case (e.g.,
// `HelloWorld`) and file names prefixed with `class-` and hyphenated (e.g.,
// `class-hello-world.php`). You can also build your own autoloader or utilize
// the autoloader in Composer.
spl_autoload_register(
	function( $class ) {

			\Hybrid\autoload(
				$class, [
					'namespace' => __NAMESPACE__,
					'path'      => get_parent_theme_file_path( 'app' ),
				]
			);
	}
);

// ------------------------------------------------------------------------------
// Autoload functions files.
// ------------------------------------------------------------------------------
//
// Load any functions-files from the `/app` folder that are needed. Add additional
// files to the array without the `.php` extension.
array_map(
	function( $file ) {
		require_once get_parent_theme_file_path( "app/{$file}.php" );
	},
	[
		'functions-assets',
		'functions-filters',
		'functions-fonts',
		'functions-helpers',
		'functions-svg',
		'functions-setup',
		'template-general',
	]
);
