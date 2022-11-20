<?php
/**
 * Post content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php post_class( 'entry' ); ?>>
	<header class="entry__header">
		<?php get_template_part( 'resources/views/partials/byline', '', [ 'class' => 'pb-2' ] ); ?>
	</header>

	<?php
		Syopajatyo\post_thumbnail();
		Syopajatyo\display_excerpt();
	?>

	<div class="entry__content">
		<?php
		the_content();
		?>
	</div>

	<footer class="entry__footer">
		<?php
			Syopajatyo\display_terms( [
				'taxonomy' => 'category',
				'before'   => '<span class="terms-wrapper"><span class="screen-reader-text">' . esc_html__( 'Categories:', 'syopajatyo' ) . ' </span>' . Syopajatyo\get_svg( [ 'icon' => 'folder-open' ] ),
				'after'    => '</span>',
			] );

			Syopajatyo\display_terms( [
				'taxonomy' => 'post_tag',
				'before'   => '<span class="terms-wrapper"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'syopajatyo' ) . ' </span>' . Syopajatyo\get_svg( [ 'icon' => 'hashtag' ] ),
				'after'    => '</span>',
			] );
		?>
	</footer>
</article>
