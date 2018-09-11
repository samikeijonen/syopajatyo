<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package Syopajatyo
 */

// Load header/* template.
Hybrid\View\display( 'header', Hybrid\Template\hierarchy() );
?>
<div class="px-2 py-8">
	<div class="grid mx-auto max-width-1">
		<main id="main" class="app-main archive grid__main">
		<?php
			tribe_events_before_html();
			tribe_get_view();
			tribe_events_after_html();
		?>
		</main>
		<?php
			// Load sidebar/* template.
			Hybrid\View\display( 'sidebar', 'primary', [ 'name' => 'primary' ] );
		?>
	</div>
</div>
<?php
// Load footer/* template.
Hybrid\View\display( 'footer', Hybrid\Template\hierarchy() );
