<?php
/**
 * Default content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\Attr\render( 'entry' ); ?>>
	<?php
		Syopajatyo\post_thumbnail();
		Syopajatyo\display_excerpt();
	?>

	<div class="entry__content">
		<?php
		the_content();
		Hybrid\View\render( 'partials', 'pagination-singular' );
		?>
	</div>
</article>
