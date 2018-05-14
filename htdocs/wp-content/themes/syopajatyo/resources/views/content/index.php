<?php
/**
 * Content template.
 *
 * @package Syopajatyo
 */

?>
<main id="main" class="app-main grid grid--blog px-2 py-4 mx-auto max-width-1">
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
