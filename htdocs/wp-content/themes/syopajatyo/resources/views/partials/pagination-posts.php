<?php
/**
 * Posts pagination.
 *
 * @package Syopajatyo
 */

the_posts_pagination(
	array(
		'prev_text'          => Syopajatyo\get_svg( [ 'icon' => 'arrow-left' ] ) . '<span class="screen-reader-text">' . __( 'Previous page', 'syopajatyo' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'syopajatyo' ) . '</span>' . Syopajatyo\get_svg( [ 'icon' => 'arrow-right' ] ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'syopajatyo' ) . ' </span>',
	)
);
