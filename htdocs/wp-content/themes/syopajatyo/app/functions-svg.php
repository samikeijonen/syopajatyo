<?php
/**
 * SVG icons related functions and filters
 *
 * @package Syopajatyo
 */

namespace Syopajatyo;

/**
 * Return SVG markup.
 *
 * This function is only for decorative SVG icons.
 * Put SVG markup in template file directly if there needs to
 * be custom markup or classes.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 * }
 * @return string SVG markup.
 */
function get_svg( $args = [] ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'syopajatyo' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'syopajatyo' );
	}

	// Set defaults.
	$defaults = [
		'fallback' => false,
		'icon'     => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Get SVG markup. Classes and other markup is added in build process.
	$svg = file_get_contents( get_theme_file_path( '/dist/svg/' . esc_attr( $args['icon'] ) . '.svg' ) );

	// Return empty if there is no icon.
	return $svg ? $svg : '';
}

/**
 * Return SVG image markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 * }
 * @return string SVG image markup.
 */
function get_svg_img( $args = [] ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'syopajatyo' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'syopajatyo' );
	}

	// Set defaults.
	$defaults = [
		'alt'      => '',
		'class'    => '',
		'fallback' => false,
		'folder'   => 'svg',
		'icon'     => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Get SVG markup. Classes and other markup is added in build process.
	$svg = '<img src="' . get_theme_file_uri( '/dist/' . esc_attr( $args['folder'] ) . '/' . esc_attr( $args['icon'] ) . '.svg' ) . '" alt="' . esc_attr( $args['alt'] ) . '" class="' . esc_attr( $args['class'] ) . '" role="img">';

	// Return empty if there is no icon.
	return $svg ? $svg : '';
}

/**
 * Display SVG Markup.
 *
 * @param array $args The parameters needed to get the SVG.
 */
function display_svg_img( $args = [] ) {
	echo get_svg_img( $args ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
}

/**
 * Display SVG image.
 *
 * @param array $args The parameters needed to get the SVG.
 */
function display_svg( $args = [] ) {
	echo get_svg( $args ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location || 'social-footer' === $args->theme_location || 'social-front-page' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . get_svg( [ 'icon' => esc_attr( $value ) ] ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );

/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string  $title The menu item's title.
 * @param  WP_Post $item  The current menu item.
 * @param  array   $args  An array of wp_nav_menu() arguments.
 * @param  int     $depth Depth of menu item. Used for padding.
 * @return string  $title The menu item's title with dropdown icon.
 */
function dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . get_svg( [ 'icon' => 'angle-down' ] );
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', __NAMESPACE__ . '\dropdown_icon_to_menu_link', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function social_links_icons() {
	// Supported social links icons.
	$social_links_icons = [
		'facebook.com'  => 'facebook-square',
		'instagram.com' => 'instagram',
		'linkedin.com'  => 'linkedin',
		'twitter.com'   => 'twitter-square',
		'youtube.com'   => 'youtube',
	];

	/**
	 * Filter social links icons.
	 *
	 * @param array $social_links_icons Array of social links icons.
	 */
	return apply_filters( 'syopajatyo_social_links_icons', $social_links_icons ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
}
