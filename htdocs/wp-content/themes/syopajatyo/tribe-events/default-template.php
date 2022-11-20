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

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();
?>
<div class="px-2 py-8">
	<div class="grid mx-auto max-width-1">
		<main id="main" class="app-main archive grid__main">
		<?php
			echo tribe( Template_Bootstrap::class )->get_view_html();
		?>
		</main>
		<?php
			// Load sidebar/* template.
			get_template_part( 'resources/views/sidebar/default', '', [ 'name' => 'primary' ] );
		?>
	</div>
</div>
<?php
get_footer();
