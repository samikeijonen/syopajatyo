<?php
/**
 * Post content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\Attr\render( 'entry' ); ?>>
	<header class="entry__header">
		<?php Hybrid\View\render( 'partials', 'byline', [ 'class' => 'pb-2' ] ); ?>
	</header>

	<div class="entry__content">
		<?php
		the_content();
		Hybrid\View\render( 'partials', 'pagination-singular' );
		?>
	</div>

	<footer class="entry__footer">
		<?php
			Hybrid\Post\render_terms( [
				'taxonomy' => 'category',
				'before'   => '<span class="terms-wrapper"><span class="screen-reader-text">' . esc_html__( 'Categories:', 'syopajatyo' ) . ' </span>' . Syopajatyo\get_svg( [ 'icon' => 'folder-open' ] ),
				'after'    => '</span>',
			] );

			Hybrid\Post\render_terms( [
				'taxonomy' => 'post_tag',
				'before'   => '<span class="terms-wrapper"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'syopajatyo' ) . ' </span>' . Syopajatyo\get_svg( [ 'icon' => 'hashtag' ] ),
				'after'    => '</span>',
			] );
		?>
	</footer>
</article>
