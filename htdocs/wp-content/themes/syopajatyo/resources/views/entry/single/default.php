<?php
/**
 * Default content template.
 *
 * @package Syopajatyo
 */

?>
<article <?php post_class( 'entry' ); ?>>
	<?php
		Syopajatyo\post_thumbnail();
		Syopajatyo\display_excerpt();
	?>

	<div class="entry__content">
		<?php
		the_content();
		?>
	</div>
</article>
