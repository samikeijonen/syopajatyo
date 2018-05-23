<?php
/**
 * Content single template.
 *
 * @package Syopajatyo
 */

?>
<main id="main" class="app-main">
	<div class="fp-title px-2 text-center">
		<div class="mx-auto max-width-3">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<h1 class="mb-0 font-size-fp fw-200"><?php single_post_title(); ?></h1>
				<?php
			endwhile;
		endif;
		?>
		</div>
	</div>

	<?php
	// Articles section.
	$syopajatyo_articles_args = [
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'no_found_rows'  => true,
	];

	$syopajatyo_articles_content = new WP_Query( $syopajatyo_articles_args );

	if ( $syopajatyo_articles_content->have_posts() ) :
		?>
		<div class="fp-articles px-2 py-8 pos-rel">
			<?php
			Syopajatyo\display_svg_img( [
				'icon'   => 'suttu1',
				'folder' => 'img',
				'class'  => 'fp-articles__bg-img pos-abs mx-auto max-width-1',
			] );
			?>

			<div class="mx-auto max-width-1 grid pos-rel z-index-11">
			<?php
			while ( $syopajatyo_articles_content->have_posts() ) :
				$syopajatyo_articles_content->the_post();
				Hybrid\render_view( 'entry/archive', 'card' );
				endwhile;
			?>
			</div>
		</div>
	<?php
	endif;
	wp_reset_postdata(); // Reset post data.

	// Featured section.
	$syopajatyo_articles_args = [
		'post_type'      => 'post',
		'posts_per_page' => 6,
		'no_found_rows'  => true,
	];

	$syopajatyo_articles_content = new WP_Query( $syopajatyo_articles_args );

	if ( $syopajatyo_articles_content->have_posts() ) :
		?>
		<div class="fp-featured px-2">
			<h2 class="fp-featured__title mx-auto max-width-1 fw-200 h1 py-8 mb-0 uppercase"><?= esc_html__( 'Support for job', 'syopajatyo' ); ?></h2>
			<div class="mx-auto max-width-1 grid">
			<?php
			while ( $syopajatyo_articles_content->have_posts() ) :
				$syopajatyo_articles_content->the_post();
				Hybrid\render_view( 'entry/archive', 'card' );
				endwhile;
			?>
			</div>
		</div>
	<?php
	endif;
	wp_reset_postdata(); // Reset post data.

	// Social media links.
	?>
</main>
