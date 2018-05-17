<?php
/**
 * Post content byline.
 *
 * @package Syopajatyo
 */

?>
<div class="entry__byline font-size-875 <?= esc_attr( $data->class ) ?>">
	<?php Hybrid\post_date(); ?>
	<?php Hybrid\post_author( [ 'before' => Syopajatyo\get_meta_sep() ] ); ?>
	<?php Hybrid\post_comments( [ 'before' => Syopajatyo\get_meta_sep() ] ); ?>
</div>
