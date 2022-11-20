<?php
/**
 * Displays navigation.
 *
 * @package Syopajatyo
 */

if ( ! has_nav_menu( $args['name'] ) ) :
	return;
endif;

$syopajatyo_social_links = wp_nav_menu(
	[
		'theme_location' => 'social',
		'container'      => '',
		'depth'          => 1,
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>' . Syopajatyo\get_svg( array( 'icon' => 'chain' ) ),
		'items_wrap'     => '%3$s',
		'fallback_cb'    => '',
		'echo'           => false,
	]
);
?>

<nav class="menu menu--<?= esc_attr( $args['name'] ) ?> px-2" id="js-menu--<?= esc_attr( $args['name'] ) ?>" aria-label="<?= esc_attr( $args['label'] ) ?>">
	<div class="menu__wrapper mx-auto max-width-1">
		<button class="menu-toggle flex items-center justify-center" aria-expanded="false" aria-controls="menu__items--<?= esc_attr( $args['name'] ) ?>">
			<svg class="menu-toggle__icon" aria-hidden="true" focusable="false" viewBox="0 0 40 40">
				<line class="menu-toggle__line menu-toggle__line--1" x1="0" y1="12" x2="40" y2="12"></line>
				<line class="menu-toggle__line menu-toggle__line--2" x1="0" y1="20" x2="40" y2="20"></line>
				<line class="menu-toggle__line menu-toggle__line--3" x1="0" y1="28" x2="40" y2="28"></line>
			</svg>
			<span><?php esc_html_e( 'Menu', 'syopajatyo' ); ?></span>
		</button>

		<?php
		wp_nav_menu( [
			'theme_location' => $args['name'],
			'container'      => '',
			'menu_id'        => 'menu__items--' . esc_attr( $args['name'] ),
			'menu_class'     => 'menu__items menu__items--' . esc_attr( $args['name'] ),
			'item_spacing'   => 'discard',
		] );

		wp_nav_menu( [
			'theme_location' => $args['social_links'],
			'container'      => '',
			'menu_id'        => 'menu__items--' . esc_attr( $args['social_links'] ),
			'menu_class'     => 'menu__items menu__items--' . esc_attr( $args['social_links'] ),
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>' . Syopajatyo\get_svg( array( 'icon' => 'chain' ) ),
			'item_spacing'   => 'discard',
			'depth'          => 1,
		] );
		?>
	</div>
</nav>
