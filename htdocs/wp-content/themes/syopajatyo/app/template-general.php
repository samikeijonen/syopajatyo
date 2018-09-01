<?php
/**
 * Template functions.
 *
 * This file holds functions related to templates.
 *
 * @package   Syopajatyo
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/samikeijonen/syopajatyo/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Syopajatyo;

/**
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @access public
 * @param  string $sep Separator for metadata.
 * @return string
 */
function sep( $sep = '' ) {

	return apply_filters(
		'syopajatyo_meta_sep',
		sprintf(
			' <span class="sep">%s</span> ',
			$sep ? $sep : esc_html_x( '&middot;', 'meta separator', 'syopajatyo' )
		)
	);
}

/**
 * The site title markup.
 *
 * @since  1.0.0
 * @access public
 */
function site_title() {
	if ( is_front_page() && is_home() ) :
	?>
		<h1 class="app-header__title mb-0 h1 fw-200 uppercase"><a class="decoration-none color-dark block" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php
			display_svg_img(
				[
					'icon'  => 'logo',
					'class' => 'site-logo',
				]
			);
			bloginfo( 'name' );
		?>
		</a></h1>
	<?php
	else :
	?>
		<p class="app-header__title mb-0 h1 fw-200 uppercase"><a class="decoration-none color-dark block" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php
			display_svg_img(
				[
					'icon'  => 'logo',
					'class' => 'site-logo',
				]
			);
			bloginfo( 'name' );
		?>
		</a></p>
	<?php
	endif;
}

/**
 * The site description markup.
 *
 * @since  1.0.0
 * @access public
 */
function site_description() {
	$description = get_bloginfo( 'description', 'display' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

	if ( $description || is_customize_preview() ) :
	?>
		<p class="mb-2"><?php echo $description; // phpcs:ignore WordPress.XSS.EscapeOutput ?></p>
	<?php
	endif;
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since  1.0.0
 * @access public
 */
function post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

		<div class="entry__thumbnail mb-4">
			<?php the_post_thumbnail(); ?>
		</div><!-- .entry__thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail block mb-2" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail', [
					'alt' => the_title_attribute(
						[
							'echo' => false,
						]
					),
				]
			);
			?>
		</a>

	<?php
	endif; // End is_singular().
}

/**
 * Get post thumbnail info.
 *
 * @param array $args post thumbnail arguments.
 *
 * @return array post thumbnail info.
 */
function get_post_thumbnail( $args = [] ) {
	// Set defaults.
	$defaults = [
		'post_thumbnail' => 'post-thumbnail',
		'id'             => get_the_ID(),
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Returns an array (url, width, height, is_intermediate) if it's set, else return false.
	$bg = false;
	if ( has_post_thumbnail( $args['id'] ) ) {
		$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id( $args['id'] ), esc_attr( $args['post_thumbnail'] ), true );
		$bg              = $thumb_url_array;
	}

	return $bg;
}

/**
 * Get post thumbnail background markup.
 *
 * @param array $args post thumbnail arguments.
 *
 * @return string post thumbnail markup.
 */
function get_post_thumbnail_bg( $args = [] ) {

	$bg = get_post_thumbnail( $args );

	// Returns bg image markup, else return empty.
	$bg_markup = '';
	if ( $bg ) {
		$bg_markup = 'style="background-image:linear-gradient( rgba(256, 256, 256, 0.85), rgba(256, 256, 256, 0.85) ), url(' . esc_url( $bg[0] ) . ');"';
	}

	return $bg_markup;
}

/**
 * Get excerpt if it exist.
 */
function display_excerpt() {
	if ( ! has_excerpt() ) {
		return;
	}
	?>

	<div class="entry__intro font-size-125"><?php wpautop( the_excerpt() ); ?></div>

<?php
}

/**
 * Get more link.
 */
function more_link() {
	return sprintf(
		'<p class="link-more mb-0"><a href="%1$s" class="more-link decoration-none uppercase" aria-hidden="true" tabindex="-1">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'syopajatyo' ), get_the_title( get_the_ID() ) )
	);
}

/**
 * Sub pages navigation
 *
 * Show hierarchial pages of current page.
 *
 * @author    Aucor
 * @copyright Copyright (c) 2018, Aucor
 * @link      https://github.com/aucor/aucor-starter/blob/master/template-tags/navigation.php
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
function sub_pages_navigation() {
	global $post;
	global $pretend_id;

	if ( ! empty( $pretend_id ) && is_numeric( $pretend_id ) ) {
		$post = get_post( $pretend_id ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		setup_postdata( $post );
	}

	$hierarchy_pos = count( $post->ancestors );

	if ( $hierarchy_pos > 3 ) {
		$great_grand_parent = wp_get_post_parent_id( $post->post_parent );
		$grand_parent       = wp_get_post_parent_id( $great_grand_parent );
		$parent             = wp_get_post_parent_id( $grand_parent );
	} elseif ( 3 === $hierarchy_pos ) {
		$grand_parent = wp_get_post_parent_id( $post->post_parent );
		$parent       = wp_get_post_parent_id( $grand_parent );
	} elseif ( 2 === $hierarchy_pos ) {
		$parent = wp_get_post_parent_id( $post->post_parent );
	} elseif ( 0 === $hierarchy_pos ) {
		$parent = $post->ID;
	} else {
		$parent = $post->post_parent;
	}

	$list = wp_list_pages(
		array(
			'echo'        => 0,
			'child_of'    => $parent,
			'link_after'  => '',
			'title_li'    => '',
			'sort_column' => 'menu_order, post_title',
		)
	);

	if ( ! empty( $list ) ) :
	?>
		<section class="widget widget--sub-pages">
			<nav class="menu menu--sidebar" id="js-menu--sidebar" aria-label="<?= esc_html__( 'Subpages', 'syopajatyo' ); ?>">
				<ul class="menu__items menu__items--sub-pages">
					<?= wp_kses_post( $list ); ?>
				</ul>
			</nav>
		</section>
	<?php
	endif;

	if ( ! empty( $pretend_id ) ) {
		wp_reset_postdata();
	}
}
