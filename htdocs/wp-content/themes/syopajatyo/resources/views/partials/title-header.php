<?php
/**
 * Title header.
 *
 * @package Syopajatyo
 */

?>
<section class="title-header px-2 py-4" role="region" aria-labelledby="region-title">
	<div class="mx-auto max-width-1">
		<?php
		if ( is_singular() || is_home() ) :
		?>
			<h1 class="title-header__title mb-0"><?php single_post_title(); ?></h1>
		<?php
		elseif ( is_archive() ) :
			the_archive_title( '<h1 id="region-title" class="archive-header__title mb-0">', '</h1>' );
			the_archive_description( '<div class="archive-header__description">', '</div>' );
		endif;
		?>
	</div>
</section>
<?php
