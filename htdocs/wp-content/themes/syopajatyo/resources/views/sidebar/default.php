<?php
/**
 * The sidebar containing widget areas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Syopajatyo
 */

if ( ! is_active_sidebar( $args['name'] ) ) :
	return;
endif
?>

<aside class="sidebar sidebar--<?= esc_attr( $args['name'] ) ?> grid__sidebar">
	<div class="sidebar__wrapper mx-auto max-width-2 font-size-875">
		<?php
			Syopajatyo\sub_pages_navigation();

			dynamic_sidebar( esc_attr( $args['name'] ) );
		?>
	</div>
</aside>
