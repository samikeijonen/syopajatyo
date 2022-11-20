<?php
/**
 * Post content byline.
 *
 * @package Syopajatyo
 */

if ( 'post' !== get_post_type() ) :
	return;
endif;
?>
<div class="entry__byline font-size-875 <?= esc_attr( $args['class'] ) ?>">
	<?php Syopajatyo\display_date(); ?>
</div>
