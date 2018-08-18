<?php
/**
 * Default content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php Hybrid\Attr\display( 'entry' ); ?>>
	<?php
		Syopajatyo\post_thumbnail();
		Syopajatyo\display_excerpt();
	?>

	<div class="entry__content">
		<?php
		the_content();
		Hybrid\View\display( 'partials', 'pagination-post' );
		?>
	</div>
</article>
