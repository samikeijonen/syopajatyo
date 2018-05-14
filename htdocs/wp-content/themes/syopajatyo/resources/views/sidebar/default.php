<?php
/**
 * The sidebar containing widget areas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Syopajatyo
 */

if ( ! is_active_sidebar( $data->name ) ) :
	return;
endif
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?> grid__span-1">
	<div class="sidebar__wrapper mx-auto max-width-2">
		<?php dynamic_sidebar( esc_attr( $data->name ) ); ?>
	</div>
</aside>
