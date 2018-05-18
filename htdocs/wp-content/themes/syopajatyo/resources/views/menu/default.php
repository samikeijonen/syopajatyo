<?php
/**
 * Displays navigation.
 *
 * @package Syopajatyo
 */

if ( ! has_nav_menu( $data->name ) ) :
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

<nav class="menu menu--<?= esc_attr( $data->name ) ?> px-2" id="js-menu--<?= esc_attr( $data->name ) ?>" aria-label="<?= esc_attr( $data->label ) ?>">
	<div class="nav-wrapper mx-auto max-width-1">
		<button id="menu-toggle" class="menu-toggle flex items-center justify-center" aria-expanded="false" aria-controls="menu__items--<?= esc_attr( $data->name ) ?>">
			<svg class="menu-toggle-icon" aria-hidden="true" focusable="false" viewBox="0 0 40 40">
				<line class="line line-1" x1="0" y1="12" x2="40" y2="12"></line>
				<line class="line line-2" x1="0" y1="20" x2="40" y2="20"></line>
				<line class="line line-3" x1="0" y1="28" x2="40" y2="28"></line>
			</svg>
			<span><?php esc_html_e( 'Menu', 'syopajatyo' ); ?></span>
		</button>

		<?php
		wp_nav_menu( [
			'theme_location' => $data->name,
			'container'      => '',
			'menu_id'        => 'menu__items--' . esc_attr( $data->name ),
			'menu_class'     => 'menu__items menu__items--' . esc_attr( $data->name ),
			'item_spacing'   => 'discard',
		] );

		wp_nav_menu( [
			'theme_location' => $data->social_links,
			'container'      => '',
			'menu_id'        => 'menu__items--' . esc_attr( $data->social_links ),
			'menu_class'     => 'menu__items menu__items--' . esc_attr( $data->social_links ),
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>' . Syopajatyo\get_svg( array( 'icon' => 'chain' ) ),
			'item_spacing'   => 'discard',
			'depth'          => 1,
		] );
		?>
	</div>
</nav>
