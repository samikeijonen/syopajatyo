<?php
/**
 * Default comment template.
 *
 * @package Syopajatyo
 */

?>
<li <?php Hybrid\Attr\render( 'comment' ); ?>>
	<header class="comment__meta flex items-center font-size-88">
		<?= get_avatar( $data->comment, 120, '', '', [ 'class' => 'comment__avatar' ] ) ?>

		<div class="comment__info">
		<?php
			Hybrid\Comment\render_author( [
				'class' => 'comment__author fw-700',
				'after' => '<br />',
			] );
			Hybrid\Comment\render_permalink( [
				'text' => sprintf(
					// Translators: 1 is the comment date and 2 is the time.
					esc_html__( '%1$s at %2$s', 'syopajatyo' ),
					Hybrid\Comment\fetch_date(),
					Hybrid\Comment\fetch_time()
				),
			] );
			Hybrid\Comment\render_edit_link( [ 'before' => Syopajatyo\sep() ] );
			Hybrid\Comment\render_reply_link( [ 'before' => Syopajatyo\sep() ] );
		?>
		</div>
	</header>

	<div class="comment__content">
		<?php if ( '0' == $data->comment->comment_approved ) : ?>
			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.', 'syopajatyo' ) ?>
			</p>
		<?php endif ?>

		<?php comment_text(); ?>
	</div>
<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
