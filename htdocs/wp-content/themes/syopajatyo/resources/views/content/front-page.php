<?php
/**
 * Content single template.
 *
 * @package Syopajatyo
 */

?>
<main id="main" class="app-main">
	<div class="fp-header px-2 text-center">
		<div class="mx-auto max-width-3">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<h1 class="fp-header__title mb-0 font-size-fp fw-200"><?php single_post_title(); ?></h1>
				<?php
			endwhile;
		endif;
		?>
		</div>
	</div>

	<?php
	// Articles section.
	$k = 1;
	while ( $k <= 3 ) :
		$syopajatyo_articles_args_{$k} = [
			'post_type'      => $k <= 2 ? 'post' : 'tribe_events',
			'cat'            => $k <= 2 ? absint( get_theme_mod( 'featured_category_' . $k ) ) : '',
			'posts_per_page' => 1,
			'no_found_rows'  => true,
		];

		$syopajatyo_articles_content_{$k} = new WP_Query( $syopajatyo_articles_args_{$k} );

		// Open section.
		if ( 1 === $k ) :
			?>
			<div class="fp-articles px-2 py-8 pos-rel">
				<div class="mx-auto max-width-1 grid pos-rel z-index-11">
				<?php
		endif;

		if ( $syopajatyo_articles_content_{$k}->have_posts() ) :
			while ( $syopajatyo_articles_content_{$k}->have_posts() ) :
				$syopajatyo_articles_content_{$k}->the_post();
				Hybrid\View\render( 'entry/archive', 'card', [ 'content' => 'ok' ] );
			endwhile;
		else :
			Hybrid\View\render( 'entry/archive', 'card', [ 'content' => 'none' ] );
		endif;

		// Close section.
		if ( 3 === $k ) :
			?>
			</div>
		</div>
		<?php
		endif;

		wp_reset_postdata(); // Reset post data.
		$k++;
	endwhile;

	// Featured section.
	$syopajatyo_pages_args = [
		'post_type'      => 'page',
		'post__in'       => Syopajatyo\featured_pages(),
		'posts_per_page' => 9,
		'no_found_rows'  => true,
		'orderby'        => 'post__in',
	];

	$syopajatyo_pages_content = new WP_Query( $syopajatyo_pages_args );

	if ( $syopajatyo_pages_content->have_posts() ) :
		?>
		<div class="fp-featured px-2">
			<h2 class="fp-featured__title mx-auto max-width-1 fw-200 h1 py-8 mb-0 uppercase"><?= esc_html__( 'Support for job', 'syopajatyo' ); ?></h2>
			<div class="mx-auto max-width-1 grid">
				<?php
				while ( $syopajatyo_pages_content->have_posts() ) :
					$syopajatyo_pages_content->the_post();
					Hybrid\View\render( 'entry/archive', 'card', [ 'content' => 'ok' ] );
				endwhile;
				?>
			</div>
		</div>
	<?php
	endif;
	wp_reset_postdata(); // Reset post data.

	// Social media links.
	?>
	<div class="fp-social-links px-2 py-8">
		<div class="mx-auto max-width-2 text-center">
		<h2 class="fp-social-links__title fw-200 h1 uppercase"><?= esc_html__( 'Follow us', 'syopajatyo' ); ?></h2>
		<?php
			Hybrid\View\render( 'menu', 'social', [
				'name'  => 'social-front-page',
				'label' => __( 'Social links', 'syopajatyo' ),
			] );
		?>
		</div>
	</div>
</main>
