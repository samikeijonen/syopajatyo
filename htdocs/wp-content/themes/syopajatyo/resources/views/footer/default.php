<?php
/**
 * The footer for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Syopajatyo
 */

?>
	<footer class="app-footer px-2 py-4">
		<div class="mx-auto max-width-1">
			<?php Hybrid\render_view( 'menu', 'social', [ 'name' => 'social' ] ); ?>

			<p class="app-footer__credit text-center mb-0">
				<?php esc_html_e( 'Powered by crazy ideas and passion', 'syopajatyo' ); ?>
				<span class="sep"> &middot; </span>
				<?php
					/* translators: %1$s is theme name, and %2$s is link to theme site. */
					printf( esc_html__( 'Theme %1$s by %2$s', 'syopajatyo' ), 'Syopajatyo', '<a href="https://foxland.fi/">Foxland</a>' );
				?>
			</p>
		</div>
	</footer>

</div><!-- .app -->

<?php wp_footer(); ?>
</body>
</html>
