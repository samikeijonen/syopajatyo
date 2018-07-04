<?php
/**
 * Content template.
 *
 * @package Syopajatyo
 */

?>
		<main id="main" class="app-main archive grid__main py-8 px-2">
		<?php
		the_archive_description( '<div class="entry__intro max-width-2 mx-auto font-size-125">', '</div>' );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				Hybrid\render_view( 'entry/archive', Hybrid\get_post_hierarchy() );
			endwhile;

			Hybrid\render_view( 'partials', 'pagination-posts' );
		endif;
		?>
		</main>

		<?php
		// Load sidebar/* template.
		Hybrid\render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] );
		?>
