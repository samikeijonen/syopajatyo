<?php
/**
 * Autoload bootstrap file.
 *
 * This file is used to autoload classes and functions necessary for the theme
 * to run.
 *
 * @package   Syopajatyo
 */

namespace Syopajatyo;

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
