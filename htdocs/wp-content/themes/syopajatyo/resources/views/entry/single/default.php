<?php
/**
 * Default content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\attr( 'entry' ); ?>>
	<div class="entry__content">
		<?php
		the_content();
		Hybrid\render_view( 'partials', 'pagination-singular' );
		?>
	</div>
</article>
