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

namespace Syopajatyo;

use function Hybrid\app;
use function Hybrid\autoload;

// Load Hybrid Core.
app();

/**
 * Bootstrap the theme.
 *
 * If the theme needs a more robust bootstrapping process, it's recommended to
 * create a `/bootstrap` folder and load those bootstrap files from here.
 * Register an autoloader for handling class loading. We're using Hybrid Core's
 * built-in autoloader for simplicity. Class names should be in Pascal Case (e.g.,
 * `HelloWorld`) and file names prefixed with `class-` and hyphenated (e.g.,
 * `class-hello-world.php`). You can also build your own autoloader or utilize
 * the autoloader in Composer.
 */
spl_autoload_register(
	function( $class ) {
			autoload(
				$class, [
					'namespace' => __NAMESPACE__,
					'path'      => get_parent_theme_file_path( 'app' ),
				]
			);
	}
);

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

// Registers a single instance of our `Customize` class with the container.
// Also calls the `boot()` method to fire it's action/filter hooks.
app()->instance( 'syopajatyo/customize', new Customize() )->boot();
