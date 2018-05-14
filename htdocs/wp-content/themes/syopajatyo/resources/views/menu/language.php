<?php
/**
 * Displays language navigation.
 *
 * @package Syopajatyo
 */

if ( ! has_nav_menu( $data->name ) ) :
	return;
endif
?>

<nav class="menu menu--<?= esc_attr( $data->name ) ?> pb-1 font-size-88">
	<?php
	wp_nav_menu( [
		'theme_location' => $data->name,
		'container'      => '',
		'menu_class'     => 'menu__items menu__items--' . esc_attr( $data->name ),
		'item_spacing'   => 'discard',
		'depth'          => 1,
	] );
	?>
</nav>
