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
<section class="title-header px-2 py-4" role="region" aria-labelledby="region-title">
	<div class="mx-auto max-width-1">
		<?php
		if ( is_singular() || is_home() ) :
		?>
			<h1 class="title-header__title mb-0" id="region-title"><?php single_post_title(); ?></h1>
		<?php
		elseif ( is_archive() ) :
			the_archive_title( '<h1 class="archive-header__title mb-0" id="region-title">', '</h1>' );
			the_archive_description( '<div class="archive-header__description">', '</div>' );
		elseif ( is_search() ) :
			/* translators: %s: search query. */
			printf( '<h1 class="title-header__title mb-0" id="region-title">' . esc_html__( 'Search Results for: %s', 'syopajatyo' ) . '</h1>', '<span>' . get_search_query() . '</span>' );
		endif;
		?>
	</div>
</section>
<?php
