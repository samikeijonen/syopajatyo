<?php
/**
 * Displays social links navigation.
 *
 * @package Syopajatyo
 */

if ( ! has_nav_menu( $args['name'] ) ) :
	return;
endif
?>

<nav class="menu menu--<?= esc_attr( $args['name'] ) ?>" aria-label="<?= esc_attr( $args['label'] ) ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => $args['name'],
		'container'      => '',
		'menu_id'        => '',
		'menu_class'     => 'menu__items menu__items--' . esc_attr( $args['name'] ),
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>' . Syopajatyo\get_svg( [ 'icon' => 'chain' ] ),
		'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		'item_spacing'   => 'discard',
		'depth'          => 1,
	] );
	?>
</nav>
