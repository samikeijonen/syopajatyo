<?php
/**
 * Archive template.
 *
 * @package Syopajatyo
 */

// Get background image.
$syopajatyo_bg = Syopajatyo\get_post_thumbnail_bg();
?>
<article <?php Hybrid\attr( 'entry', 'card' ); ?><?= wp_kses_post( $syopajatyo_bg ); ?>>
	<header class="entry__header">
		<?php
		if ( 'tribe_events' === get_post_type() ) :
			echo '<span class="entry__terms"><a href="/tapahtumat/">' . esc_html__( 'Events', 'syopajatyo' ) . '</a></span>';
		else :
			Hybrid\post_terms( [
				'taxonomy' => 'category',
			] );
		endif;
		?>
		<h2 class="entry__title h3"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry__summary font-size-875">
		<?php the_excerpt(); ?>
	</div>
</article>
