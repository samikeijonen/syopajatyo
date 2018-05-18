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
	</div>
</div>
