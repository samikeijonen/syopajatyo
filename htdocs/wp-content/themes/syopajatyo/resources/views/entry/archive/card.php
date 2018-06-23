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
		if ( 'tribe_events' === get_post_type() || 'none' === $data->content ) :
			echo '<span class="entry__terms"><a href="/tapahtumat/">' . esc_html__( 'Events', 'syopajatyo' ) . '</a></span>';
		else :
			Hybrid\post_terms( [
				'taxonomy' => 'category',
			] );
		endif;

		if ( 'none' === $data->content ) :
		?>
			<h2 class="entry__title h3"><?= esc_html__( 'There are no upcoming events', 'syopajatyo' ); ?></h2>
		<?php else : ?>
			<h2 class="entry__title h3"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
	</header>

	<div class="entry__summary font-size-875">
		<?php
		if ( 'none' === $data->content ) :
			esc_html_e( 'Unfortunately there was no upcoming events found.', 'syopajatyo' );
		else :
			the_excerpt();
		endif;
		?>
	</div>
</article>
