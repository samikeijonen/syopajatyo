<?php
/**
 * Content single template.
 *
 * @package Syopajatyo
 */

?>
<div class="px-2 py-8">
	<div class="grid mx-auto max-width-1">
		<main id="main" class="app-main grid__main">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				Hybrid\View\display( 'entry/single', Hybrid\Post\hierarchy() );
				endwhile;

			comments_template();

			endif;
		?>
		</main>

		<?php
		// Load sidebar/* template.
		Hybrid\View\display( 'sidebar', 'primary', [ 'name' => 'primary' ] );
		?>
	</div>
</div>
