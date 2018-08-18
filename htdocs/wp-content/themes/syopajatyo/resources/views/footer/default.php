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
			<p class="grid-footer__item grid-footer__logos mb-0">
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

			<div class="grid-footer__item grid-footer__credit">
				<ul class="reset-list pb-4">
					<li class="fw-600 uppercase">Suomen syöpäpotilaat Ry</li>
					<li>Malminkaari 5</li>
					<li>00700 Helsinki</li>
					<li>Email: info@syopapotilaat.fi</li>
					<li><a href="https://www.syopapotilaat.fi/">www.syopapotilaat.fi</a></li>
				</ul>
				<?php
					Hybrid\View\display( 'menu', 'social', [
						'name'  => 'social-footer',
						'label' => __( 'Social links', 'syopajatyo' ),
					] );

					echo '<p class="mb-0">' . esc_html__( 'Design: Kumu Communications &#38; Milart', 'syopajatyo' ) . '</p>';
					echo '<p class="mb-0">' . esc_html__( 'Illustrations: Milart', 'syopajatyo' ) . '</p>';
				?>
			</div>

			<div class="grid-footer__item grid-footer__info mb-0">
				<p>
				Minä, syöpä ja työ &ndash; Vertaistukea, kannustusta, tietoa, verkostoja ja tapahtumia.
				</p>
				<p>
				STEA tukee hanketta "Elossa ja osallisena, myös työelämässä!" (2017-2020)
				</p>
			</div>
		</div>
	</footer>

</div><!-- .app -->

<?php wp_footer(); ?>
</body>
</html>
