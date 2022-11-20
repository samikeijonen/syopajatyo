<?php
/**
 * Archive template.
 *
 * @package Syopajatyo
 */

?>
<article <?php post_class( 'entry entry--archive' ); ?>>
	<header class="entry__header">
		<?php get_template_part( 'resources/views/partials/byline', '', [ 'class' => 'pb-1' ] ); ?>
		<h2 class="entry__title"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry__summary font-size-875">
		<?php Syopajatyo\post_thumbnail(); ?>
		<div class="post-excerpt"><?php the_excerpt(); ?></div>
	</div>
</article>
