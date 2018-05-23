<?php
/**
 * Displays social links navigation.
 *
 * @package Syopajatyo
 */

if ( ! has_nav_menu( $data->name ) ) :
	return;
endif
?>

<nav class="menu menu--<?= esc_attr( $data->name ) ?>" aria-label="<?= esc_attr( $data->label ) ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => $data->name,
		'container'      => '',
		'menu_id'        => '',
		'menu_class'     => 'menu__items menu__items--' . esc_attr( $data->name ),
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>' . Syopajatyo\get_svg( [ 'icon' => 'chain' ] ),
		'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		'item_spacing'   => 'discard',
		'depth'          => 1,
	] );
	?>
</nav>
