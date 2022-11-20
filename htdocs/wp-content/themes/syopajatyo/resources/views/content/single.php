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

				if ( is_single() ) :
					get_template_part( 'resources/views/entry/single/post' );
				else :
					get_template_part( 'resources/views/entry/single/default' );
				endif;
				endwhile;
			endif;
		?>
		</main>

		<?php
		// Load sidebar/* template.
		get_template_part( 'resources/views/sidebar/default', '', [ 'name' => 'primary' ] );
		?>
	</div>
</div>
