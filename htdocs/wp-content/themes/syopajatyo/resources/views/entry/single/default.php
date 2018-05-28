<?php
/**
 * Default content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\attr( 'entry' ); ?>>
	<?= Syopajatyo\get_excerpt(); ?>

	<div class="entry__content">
		<?php
		the_content();
		Hybrid\render_view( 'partials', 'pagination-singular' );
		?>
	</div>
</article>
