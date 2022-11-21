<?php
/**
 * Filter functions.
 *
 * This file holds functions that are used for filtering.
 *
 * @package   Syopajatyo
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/samikeijonen/syopajatyo/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Syopajatyo;

/**
 * Filters the WP nav menu link attributes.
 *
 * @param array    $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $title  Title attribute.
 *     @type string $target Target attribute.
 *     @type string $rel    The rel attribute.
 *     @type string $href   The href attribute.
 * }
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string  $attr
 */
add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
	// Get theme location, fallback for `default`.
	$theme_location = $args->theme_location ? $args->theme_location : 'default';

	// Start adding custom classes.
	$atts['class'] = 'menu__anchor menu__anchor--' . $theme_location;

	// Add `is-active` class.
	if ( in_array( 'current-menu-item', $item->classes, true ) ) {
		$atts['class'] .= ' is-active';
	}

	// Add `menu__anchor--button` when there is `button` class in `<li>` element.
	if ( in_array( 'button', $item->classes, true ) ) {
		$atts['class'] .= ' menu__anchor--button';
	}

	// Add `is-ancestor` class.
	if ( in_array( 'current-page-ancestor', $item->classes, true ) || in_array( 'current-menu-ancestor', $item->classes, true ) ) {
		$atts['class'] .= ' is-ancestor';
	}

	// Add `is-top-level` class using $depth parameter.
	if ( 0 === $depth ) {
		$atts['class'] .= ' is-top-level';
	}

	return $atts;
}, 10, 4 );

/**
 * Filters the HTML attributes applied to a page menu item's anchor element.
 *
 * @param array $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $href The href attribute.
 * }
 * @param WP_Post $page         Page data object.
 * @param int     $depth        Depth of page, used for padding.
 * @param array   $args         An array of arguments.
 * @param int     $current_page ID of the current page.
 */
add_filter( 'page_menu_link_attributes', function( $atts, $page, $depth, $args, $current_page ) {
	// Used for child pages menu.
	$atts['class'] = 'menu__anchor menu__anchor--sub-menu';

	// Add active page class.
	if ( $current_page === $page->ID ) {
		$atts['class'] .= ' is-active';
	}

	// Add `has-children` class.
	if ( $args['has_children'] ) {
		$atts['class'] .= ' has-children';
	}

	// Add `is-top-level` class using $depth parameter.
	if ( 0 === $depth ) {
		$atts['class'] .= ' is-top-level';
	}

	return $atts;
}, 10, 5 );

/**
 * Filters the CSS classes applied to a menu item's list item element.
 *
 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 */
function nav_menu_css_class( $classes, $item, $args, $depth ) {
	// Add class if theme location is unknown, like in widgets.
	if ( ! $args->theme_location ) {
		$classes[] = 'menu__item--default';
	}

	// Add `is-top-level` class using $depth parameter.
	if ( 0 === $depth ) {
		$classes[] = 'is-top-level';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\nav_menu_css_class', 10, 4 );

/**
 * Filters the list of CSS classes to include with each page item in the list.
 *
 * @see wp_list_pages()
 *
 * @param string[] $css_class    An array of CSS classes to be applied to each list item.
 * @param WP_Post  $page         Page data object.
 * @param int      $depth        Depth of page, used for padding.
 * @param array    $args         An array of arguments.
 * @param int      $current_page ID of the current page.
 */
function page_css_class( $css_class, $page, $depth, $args, $current_page ) {
	// Used for child pages menu.
	$css_class = [ 'menu__item menu__item--sub-menu' ];

	// Add `has-children` class.
	if ( in_array( 'page_item_has_children', $css_class, true ) ) {
		$css_class[] = 'has-children';
	}

	// Add custom menu ancestor class.
	if ( in_array( 'current_page_ancestor', $css_class, true ) ) {
		$css_class[] = 'menu__item--ancestor';
	}

	// Add `is-top-level` class using $depth parameter.
	if ( 0 === $depth ) {
		$css_class[] = 'is-top-level';
	}

	return $css_class;
}
add_filter( 'page_css_class', __NAMESPACE__ . '\page_css_class', 10, 5 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = more_link();

	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param  string $excerpt Read more link to single post/page.
 * @return string 'Continue reading' link prepended.
 */
function get_the_excerpt( $excerpt ) {
	$link = '';

	if ( has_excerpt() && ( ! is_singular() || is_front_page() ) ) {
		$link = more_link();
	}

	return $excerpt . $link;
}
add_filter( 'get_the_excerpt', __NAMESPACE__ . '\get_the_excerpt' );

/**
 * Filter the excerpt length.
 *
 * @param  int $length Excerpt length.
 * @return int Modified excerpt length.
 */
function excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return is_front_page() ? 20 : 55;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\excerpt_length' );

/**
 * Prevent automatic optimization for PDF.
 *
 * @author Grégory Viguier
 * @author Caspar Hübinger
 *
 * @param  bool  $optimize      True to optimize, false otherwise.
 * @param  int   $attachment_id Attachment ID.
 * @param  array $metadata      An array of attachment meta data.
 * @return bool
 */
function no_optimize_pdf( $optimize, $attachment_id, $metadata ) {
	if ( ! $optimize ) {
		return false;
	}

	$mime_type = get_post_mime_type( $attachment_id );

	return 'application/pdf' !== $mime_type;
}
add_filter( 'imagify_auto_optimize_attachment', __NAMESPACE__ . '\no_optimize_pdf', 10, 3 );
