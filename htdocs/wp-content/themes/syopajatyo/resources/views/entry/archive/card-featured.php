<?php
/**
 * Card template for featured pages.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\Attr\display( 'entry', 'card' ); ?>>
	<header class="entry__header">
		<?php
		Syopajatyo\display_svg_img(
			[
				'icon'  => esc_attr( $data->page_slug ) . '-icon',
				'class' => 'entry__icon entry__icon--' . esc_attr( $data->page_slug ),
				'alt'   => '',
			]
		);
		?>
		<h2 class="entry__title h3"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry__summary font-size-875">
		<?php the_excerpt(); ?>
	</div>
</article>
