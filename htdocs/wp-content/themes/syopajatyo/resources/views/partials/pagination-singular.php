<?php
/**
 * Singular pagination.
 *
 * @package Syopajatyo
 */

wp_link_pages( [
	'before' => '<nav class="pagination pagination--singular"><div class="pagination__items pagination__items--singular">',
	'after'  => '</div></nav>',
	'link_before' => '<span class="pagination__anchor">',
	'link_after'  => '</span>',
] );
