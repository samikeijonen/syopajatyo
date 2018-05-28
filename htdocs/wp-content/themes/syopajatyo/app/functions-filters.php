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

use Hybrid;

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
	$atts['class'] = 'menu__anchor menu__anchor--' . $args->theme_location;

	if ( in_array( 'current-menu-item', $item->classes, true ) ) {
		$atts['class'] .= ' is-active';
	}

	if ( in_array( 'button', $item->classes, true ) ) {
		$atts['class'] .= ' menu__anchor--button';
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
	$atts['class'] = 'menu__anchor menu__anchor--sub-menu';

	if ( $current_page === $page->ID ) {
		$atts['class'] .= ' is-active';
	}

	if ( $args['has_children'] ) {
		$atts['class'] .= ' has-children';
	}

	if ( 0 === $depth ) {
		$atts['class'] .= ' is-top-level';
	}

	return $atts;
}, 10, 5 );

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
add_filter( 'page_css_class', function( $css_class, $page, $depth, $args, $current_page ) {
	$css_class['class'] = 'menu__item menu__item--sub-menu';

	if ( in_array( 'page_item_has_children', $css_class, true ) ) {
		$css_class['class'] .= ' has-children';
	}

	if ( in_array( 'current_page_ancestor', $css_class, true ) ) {
		$css_class['class'] .= ' menu__item--ancestor';
	}

	if ( 0 === $depth ) {
		$css_class['class'] .= ' is-top-level';
	}

	return $css_class;
}, 10, 5 );

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
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended.
 */
function get_the_excerpt( $excerpt ) {
	$link = '';

	if ( has_excerpt() && ( ! is_page() || is_front_page() ) ) {
		$link = more_link();
	}

	return $excerpt . $link;
}
add_filter( 'get_the_excerpt', __NAMESPACE__ . '\get_the_excerpt' );

/**
 * Filter the excerpt length.
 *
 * @param int $length Excerpt length.
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
 * Filters the HTML output of the search form.
 *
 * Look searchform.php in resources/views folder.
 *
 * @param string $form The search form HTML output.
 */
add_filter( 'get_search_form', function( $form ) {
	$template = Hybrid\locate_template( 'searchform.php' );

	if ( $template ) {
		ob_start();
		include $template;
		$form = ob_get_clean();
	}

	return $form;
}, 0 );

add_filter( 'navigation_markup_template', function( $template, $class ) {
	$template = '
	<nav class="navigation %1$s %1$s--posts" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="pagination__items">%3$s</div>
	</nav>';

	return $template;
}, 10, 2 );
