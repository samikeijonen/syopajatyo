<?php
/**
 * Title header.
 *
 * @package Syopajatyo
 */

if ( is_front_page() ) :
	return;
endif;
?>
<section class="title-header px-2 py-4 pos-rel" role="region" aria-labelledby="region-title">
	<?php
	Syopajatyo\display_svg_img( [
		'icon'   => 'piirros1',
		'folder' => 'img',
		'class'  => 'title-header__bg-img pos-abs',
	] );
	?>
	<div class="mx-auto max-width-1">
		<?php
		if ( is_singular() || is_home() ) :
		?>
			<h1 class="title-header__title max-width-2 mb-0 fw-200 uppercase" id="region-title"><?php single_post_title(); ?></h1>
		<?php
		elseif ( is_archive() ) :
			the_archive_title( '<h1 class="title-header__title archive-header__title max-width-2 mb-0 fw-200 uppercase" id="region-title">', '</h1>' );
		elseif ( is_search() ) :
			/* translators: %s: search query. */
			printf( '<h1 class="title-header__title max-width-2 mb-0 fw-200 uppercase" id="region-title">' . esc_html__( 'Search Results for: %s', 'syopajatyo' ) . '</h1>', '<span>' . get_search_query() . '</span>' );
		endif;
		?>
	</div>
</section>
<?php
