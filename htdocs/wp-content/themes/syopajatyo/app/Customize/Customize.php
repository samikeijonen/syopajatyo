<?php
/**
 * Customize class.
 *
 * This files shows some basics on how to set up and work with the WordPress
 * Customization API. This is the place to set up all of your theme options for
 * the customizer.
 *
 * @package   Syopajatyo
 */

namespace Syopajatyo\Customize;

use WP_Customize_Manager;
use Hybrid\Contracts\Bootable;
use Hybrid;

/**
 * Handles setting up everything we need for the customizer.
 *
 * @link   https://developer.wordpress.org/themes/customize-api
 * @since  1.0.0
 * @access public
 */
class Customize implements Bootable {

	/**
	 * Adds actions on the appropriate customize action hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', [ $this, 'register_panels' ] );
		add_action( 'customize_register', [ $this, 'register_sections' ] );
		add_action( 'customize_register', [ $this, 'register_settings' ] );
		add_action( 'customize_register', [ $this, 'register_controls' ] );
		add_action( 'customize_register', [ $this, 'register_partials' ] );

		// Enqueue scripts and styles.
		add_action( 'customize_controls_enqueue_scripts', [ $this, 'controls_enqueue' ] );
		add_action( 'customize_preview_init', [ $this, 'preview_enqueue' ] );
	}

	/**
	 * Callback for registering panels.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#panels
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager $manager Theme Customizer object.
	 * @return void
	 */
	public function register_panels( WP_Customize_Manager $manager ) {}

	/**
	 * Callback for registering sections.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#sections
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager $manager Theme Customizer object.
	 * @return void
	 */
	public function register_sections( WP_Customize_Manager $manager ) {
		// Add the front-page-featured-featured section.
		$manager->add_section(
			'front-page-featured',
			[
				'title'    => esc_html__( 'Front Page Featured Area', 'syopajatyo' ),
				'priority' => 10,
			]
		);
	}

	/**
	 * Callback for registering settings.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#settings
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager $manager Theme Customizer object.
	 * @return void
	 */
	public function register_settings( WP_Customize_Manager $manager ) {
		// Update the `transform` property of core WP settings.
		$settings = [
			$manager->get_setting( 'blogname' ),
			$manager->get_setting( 'blogdescription' ),
		];

		array_walk(
			$settings, function( &$setting ) {
				$setting->transport = 'postMessage';
			}
		);
	}

	/**
	 * Callback for registering settings and controls.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#controls
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager $manager Theme Customizer object.
	 * @return void
	 */
	public function register_controls( WP_Customize_Manager $manager ) {
		// Loop same setting couple of times.
		$k = 1;

		while ( $k <= 3 ) {
			// Add the 'featured_category_*' setting.
			$manager->add_setting(
				'featured_category_' . $k,
				[
					'default'           => 0,
					'sanitize_callback' => 'absint',
				]
			);
			// Add the 'featured_category_*' control.
			$manager->add_control(
				new Hybrid\Customize\Controls\DropdownTerms(
					$manager,
					'featured_category_' . $k,
					$args = [
						/* Translators: %s stands for number. For example Select category 1. */
						'label'    => sprintf( esc_html__( 'Select category %s', 'syopajatyo' ), $k ),
						'section'  => 'front-page-featured',
						'type'     => 'hybrid-dropdown-terms',
						'priority' => $k + 1,
					]
				)
			);

			$k++; // Add one before loop ends.
		} // End while loop.

		// Loop same setting couple of times.
		$k = 1;

		while ( $k <= 9 ) {
			// Add the 'featured_page_*' setting.
			$manager->add_setting(
				'featured_page_' . $k,
				[
					'default'           => 0,
					'sanitize_callback' => 'absint',
				]
			);
			// Add the 'featured_page_*' control.
			$manager->add_control(
				'featured_page_' . $k,
				[
					/* Translators: %s stands for number. For example Select page 1. */
					'label'    => sprintf( esc_html__( 'Select page %s', 'syopajatyo' ), $k ),
					'section'  => 'front-page-featured',
					'type'     => 'dropdown-pages',
					'priority' => $k + 20,
				]
			);

			$k++; // Add one before loop ends.
		} // End while loop.
	}

	/**
	 * Callback for registering partials.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/tools-for-improved-user-experience/#selective-refresh-fast-accurate-updates
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager $manager Theme Customizer object.
	 * @return void
	 */
	public function register_partials( WP_Customize_Manager $manager ) {
		// If the selective refresh component is not available, bail.
		if ( ! isset( $manager->selective_refresh ) ) {
			return;
		}

		// Selectively refreshes the title in the header when the core
		// WP `blogname` setting changes.
		$manager->selective_refresh->add_partial(
			'blogname', [
				'selector'        => '.app-header__title a',
				'render_callback' => function() {
					return get_bloginfo( 'name', 'display' );
				},
			]
		);

		// Selectively refreshes the description in the header when the
		// core WP `blogdescription` setting changes.
		$manager->selective_refresh->add_partial(
			'blogdescription', [
				'selector'        => '.app-header__description',
				'render_callback' => function() {
					return get_bloginfo( 'description', 'display' );
				},
			]
		);
	}

	/**
	 * Register or enqueue js/styles for the controls that are output
	 * in the controls frame. Note that if you have js/styles that are
	 * only needed for specific controls, you should register those here and
	 * enqueue them via the `enqueue()` method of your custom control class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function controls_enqueue() {}

	/**
	 * Register or enqueue js/styles for the live preview frame.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function preview_enqueue() {

		wp_enqueue_script(
			'syopajatyo-customize-preview',
			asset( 'js/customize-preview.js' ),
			[ 'customize-preview' ],
			false,
			true
		);
	}
}
