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
<div class="entry__byline font-size-875 <?= esc_attr( $data->class ) ?>">
	<?php Hybrid\Post\display_date(); ?>
	<?php Hybrid\Post\display_comments_link( [ 'before' => Syopajatyo\sep() ] ); ?>
</div>
