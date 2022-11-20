<?php
/**
 * Displays language navigation.
 *
 * @package Syopajatyo
 */

if ( ! has_nav_menu( $args['name'] ) ) :
	return;
endif
?>

<nav class="menu menu--<?= esc_attr( $args['name'] ) ?> pb-1 font-size-88" aria-label="<?= esc_attr( $args['label'] ) ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => $args['name'],
		'container'      => '',
		'menu_class'     => 'menu__items menu__items--' . esc_attr( $args['name'] ),
		'item_spacing'   => 'discard',
		'depth'          => 1,
	] );
	?>
</nav>
