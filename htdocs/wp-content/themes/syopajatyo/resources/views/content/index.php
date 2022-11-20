<?php
/**
 * Content template.
 *
 * @package Syopajatyo
 */

?>
<div class="px-2 py-8">
	<div class="grid mx-auto max-width-1">
		<main id="main" class="app-main archive grid__main">
		<?php
		the_archive_description( '<div class="entry__intro font-size-125">', '</div>' );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				get_template_part( 'resources/views/entry/archive/default' );
			endwhile;

			get_template_part( 'resources/views/partials/pagination-posts' );
		endif;
		?>
		</main>

		<?php
		// Load sidebar/* template.
		get_template_part( 'resources/views/sidebar/default', '', [ 'name' => 'primary' ] );
		?>
	</div>
</div>
