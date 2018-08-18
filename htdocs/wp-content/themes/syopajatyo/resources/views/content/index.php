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

				Hybrid\View\display( 'entry/archive', Hybrid\Post\hierarchy() );
			endwhile;

			Hybrid\View\display( 'partials', 'pagination-posts' );
		endif;
		?>
		</main>

		<?php
		// Load sidebar/* template.
		Hybrid\View\display( 'sidebar', 'primary', [ 'name' => 'primary' ] );
		?>
	</div>
</div>
