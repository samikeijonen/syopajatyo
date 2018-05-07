<?php
/**
 * Posts pagination.
 *
 * @package Syopajatyo
 */

Hybrid\posts_pagination( [
	'prev_text'          => __( '&larr; Previous page', 'syopajatyo' ),
	'next_text'          => __( 'Next page &rarr;', 'syopajatyo' ),
	'title_text'         => __( 'Posts Navigation', 'syopajatyo' ),
	'container_class'    => 'pagination pagination--posts',
	'title_class'        => 'pagination__title screen-reader-text',
	'before_page_number' => __( 'Page', 'syopajatyo' ) . ' ',
] );
