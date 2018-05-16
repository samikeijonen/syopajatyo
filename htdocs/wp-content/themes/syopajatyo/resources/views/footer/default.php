<?php
/**
 * The footer for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Syopajatyo
 */

?>
	<footer class="app-footer px-2 py-8 font-size-875">
		<div class="grid-footer mx-auto max-width-1">
			<p class="grid-footer__logos mb-0">
			<?php
				Syopajatyo\display_svg_img( [
					'icon'  => 'logo-text',
					'class' => 'svg-img svg-img--site-logo',
					'alt'   => get_bloginfo( 'name' ),
				] );

				Syopajatyo\display_svg_img( [
					'icon'  => 'logo-potilaat',
					'class' => 'svg-img svg-img--potilaat',
				] );
			?>
			</p>

			<div class="grid-footer__credit">
				<ul class="reset-list pb-4">
					<li class="fw-600 uppercase">Suomen syöpäpotilaat Ry</li>
					<li>Malminkatu 5</li>
					<li>00700 Helsinki</li>
					<li>Email: info@syopapotilaat.fi</li>
				</ul>
				<?php
					Hybrid\render_view( 'menu', 'social', [
						'name'  => 'social-footer',
						'label' => __( 'Social links', 'syopajatyo' ),
					] );

					echo '<p class="mb-0">' . esc_html__( 'Design: Kumu Communications &#38; Milart Illustrations by Milart', 'syopajatyo' ) . '</p>';
				?>
			</div>

			<p class="grid-footer__info mb-0">
				Cras volutpat, lacus quis semper pharetra, nisi enim dignissim est.
				et sollicitudin quam ipsum vel mi. Sed commodo urna ac urna.
				Nullam eu tortor. Curabitur sodales scelerisque magna.
				Donec ultricies tristique pede.
			</p>
		</div>
	</footer>

</div><!-- .app -->

<?php wp_footer(); ?>
</body>
</html>
