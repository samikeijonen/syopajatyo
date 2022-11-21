<?php
/**
 * 404 template.
 *
 * @package Syopajatyo
 */

get_header();
?>
<main id="main" class="app-main px-2 py-8">
	<section class="entry entry--error mx-auto max-width-2">
		<header class="entry__header">
			<h1 class="entry__title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'syopajatyo' ); ?></h1>
		</header><!-- .page-header -->

		<div class="entry__content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try search?', 'syopajatyo' ); ?></p>
			<?php get_template_part( 'resources/views/partials/searchform' ); ?>
		</div>
	</section>
</main>

<?php
get_footer();
