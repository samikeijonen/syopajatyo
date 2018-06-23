<?php
/**
 * Comments.
 *
 * @package Syopajatyo
 */

if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) ) {
	return;
}
?>

<section class="comments-template">
	<div id="comments" class="comments">

		<?php if ( have_comments() ) : ?>
			<h2 class="comments__title"><?php comments_number(); ?></h2>

			<?php Hybrid\render_view( 'partials', 'pagination-comments' ); ?>

			<ol class="comments__list">
				<?php
				wp_list_comments( [
					'style'        => 'ol',
					'callback'     => function( $comment ) {
						Hybrid\render_view( 'comment', Hybrid\get_comment_hierarchy(), [ 'comment' => $comment ] );
					},
					'end-callback' => function() {
						echo '</li>';
					},
				] );
				?>
			</ol>

			<?php Hybrid\render_view( 'partials', 'pagination-comments' ); ?>

		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="comments__closed">
				<?php esc_html_e( 'Comments are closed.', 'syopajatyo' ); ?>
			</p>

		<?php endif; ?>
	</div>

	<?php comment_form(); ?>

</section>
