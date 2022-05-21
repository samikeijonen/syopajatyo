<?php
/**
 * The footer for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Syopajatyo
 */

?>
	<footer class="app-footer px-2 font-size-875">
		<div class="grid-footer mx-auto max-width-1">
			<div class="grid-footer__item grid-footer__logos mb-0">
				<?php
					Syopajatyo\display_svg_img( [
						'icon'  => 'logo-text',
						'class' => 'svg-img svg-img--site-logo',
						'alt'   => get_bloginfo( 'name' ),
					] );
				?>

				<p class="uppercase fw-600 mb-2"><?php bloginfo( 'name' ); ?></p>

				<?php Syopajatyo\site_description(); ?>

				<p><a href="https://syopajatyo.fi/suomen-syopapotilaat-ry/tietosuoja/">Tietosuoja ja rekisteriselosteet</a></p>
			</div>

			<div class="grid-footer__item grid-footer__credit">
				<?php
					Syopajatyo\display_svg_img( [
						'icon'  => 'logo-potilaat',
						'class' => 'svg-img svg-img--potilaat mb-2',
					] );
				?>

				<ul class="reset-list pb-4">
					<li class="fw-600 uppercase">Suomen Syöpäpotilaat ry</li>
					<li>Email: info@syopapotilaat.fi</li>
					<li><a href="https://www.syopapotilaat.fi/">www.syopapotilaat.fi</a></li>
				</ul>

				<?php
					Hybrid\View\display( 'menu', 'social', [
						'name'  => 'social-footer',
						'label' => __( 'Social links', 'syopajatyo' ),
					] );
				?>
			</div>

			<div class="grid-footer__item grid-footer__info">
				<img width="600" height="600" class="partner-logo partner-logo--veikkaus mb-4" src="<?php echo esc_url( get_parent_theme_file_uri( '/dist/img/tuettu_veikkauksen_tuotoilla.png' ) ); ?>" alt="<?php esc_html_e( 'Tuettu veikkauksen voitoilla', 'syopajatyo' ); ?>">
			</div>
		</div>

		<ul class="app-footer__list reset-list flex flex-wrap justify-center">
			<li>&copy; Suomen Syöpäpotilaat ry</li>
			<li>Graafinen suunnittelu: <a class="decoration-none" href="https://www.milart.fi/">Milart</a></li>
			<li>Toteutus: <a class="decoration-none" href="https://kumucommunications.fi/">Kumu Communications</a></li>
		</ul>

		<p class="text-center mb-0">Kuvat: iStock.com/spukkato, CC0 Pexels/Pixabay, Canva ja Suomen Syöpäpotilaat ry</p>
	</footer>

</div><!-- .app -->

<?php wp_footer(); ?>
</body>
</html>
