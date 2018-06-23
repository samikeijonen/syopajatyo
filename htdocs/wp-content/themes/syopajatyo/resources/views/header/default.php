<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Syopajatyo
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php Hybrid\attr( 'body' ); ?>>

<div class="app">
	<header class="app-header items-center px-2 py-2">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'syopajatyo' ); ?></a>

		<div class="flex justify-between items-center mx-auto max-width-1">
			<div class="app-header__branding">
			<?php
				Syopajatyo\site_title();
			?>
			</div>

			<div class="app-header__search">
			<?php
				Hybrid\render_view( 'menu', 'language', [
					'name'  => 'language',
					'label' => esc_html_x( 'Language', 'nav menu label', 'syopajatyo' ),
				] );

				get_search_form();
			?>
			</div>
		</div>
	</header>

	<?php
		Hybrid\render_view( 'menu', 'primary', [
			'name'         => 'primary',
			'social_links' => 'social',
			'label'        => _x( 'Primary', 'nav menu label', 'syopajatyo' ),
		] );

		Hybrid\render_view( 'partials', 'title-header' );
	?>
