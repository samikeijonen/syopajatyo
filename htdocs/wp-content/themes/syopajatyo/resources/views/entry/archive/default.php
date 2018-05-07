<?php
/**
 * Archive template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\attr( 'entry' ); ?>>
	<?php Syopajatyo\post_thumbnail(); ?>

	<header class="entry__header">
		<h2 class="entry__title h4"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry__summary font-size-88">
		<?php the_excerpt(); ?>
	</div>
</article>
