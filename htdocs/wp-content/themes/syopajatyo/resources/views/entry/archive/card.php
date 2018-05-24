<?php
/**
 * Archive template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\attr( 'entry', 'card' ); ?>>
	<header class="entry__header">
		<?php
		Hybrid\post_terms( [
			'taxonomy' => 'category',
		] );
		?>
		<h2 class="entry__title h3"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry__summary font-size-875">
		<?php the_excerpt(); ?>
	</div>
</article>
