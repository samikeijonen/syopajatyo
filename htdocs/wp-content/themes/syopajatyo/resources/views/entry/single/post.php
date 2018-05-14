<?php
/**
 * Post content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\attr( 'entry' ); ?>>
	<header class="entry__header text-center">
		<div class="entry__byline pb-2">
			<?php Hybrid\post_author(); ?>
			<?php Hybrid\post_date( [ 'before' => Syopajatyo\get_meta_sep() ] ); ?>
			<?php Hybrid\post_comments( [ 'before' => Syopajatyo\get_meta_sep() ] ); ?>
		</div>
	</header>

	<div class="entry__content">
		<?php
		the_content();
		Hybrid\render_view( 'partials', 'pagination-singular' );
		?>
	</div>

	<footer class="entry__footer">
		<?php
			Hybrid\post_terms( [
				'taxonomy' => 'category',
				'before'   => '<span class="terms-wrapper"><span class="screen-reader-text">' . esc_html__( 'Categories:', 'syopajatyo' ) . ' </span>' . Syopajatyo\get_svg( [ 'icon' => 'folder-open' ] ),
				'after'    => '</span>',
			] );

			Hybrid\post_terms( [
				'taxonomy' => 'post_tag',
				'before'   => '<span class="terms-wrapper"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'syopajatyo' ) . ' </span>' . Syopajatyo\get_svg( [ 'icon' => 'hashtag' ] ),
				'after'    => '</span>',
			] );
		?>
	</footer>
</article>
