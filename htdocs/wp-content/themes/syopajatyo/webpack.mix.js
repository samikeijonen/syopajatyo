/**
 * Laravel Mix configuration file.
 *
 * This file stores all the configuration for using Laravel Mix as our primary
 * build tool for the theme. Laravel Mix is a layer built on top of Webpack that
 * simplifies much of the complexity of Webpack's configuration, and is well
 * suited for projects like WordPress themes.
 *
 * link: https://laravel.com/docs/5.6/mix
 *
 * @package
 */

// Import required packages.
const mix = require('laravel-mix');
const CopyWebpackPlugin = require('copy-webpack-plugin');

// Sets the development path to assets. By default, this is the `/resources`
// folder in the theme.
const devPath = 'resources';

// Sets the path to the generated assets. By default, this is the `/dist` folder
// in the theme. If doing something custom, make sure to change this everywhere.
mix.setPublicPath('dist');

// Set Laravel Mix options.
//
// @link https://laravel.com/docs/5.6/mix#postcss
// @link https://laravel.com/docs/5.6/mix#url-processing
mix.options({
	postCss: [require('postcss-preset-env')()],
	processCssUrls: false,
});

// Builds sources maps for assets.
//
// @link https://laravel.com/docs/5.6/mix#css-source-maps
if (!mix.inProduction()) {
	mix.sourceMaps();
}

// Versioning and cache busting. Append a unique hash for production assets.
//
// @link https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
mix.version();

// Compile JavaScript.
//
// @link https://laravel.com/docs/5.6/mix#working-with-scripts
mix.js(`${devPath}/js/app.js`, 'js');

// Compile SASS and CSS.
//
// @link https://laravel.com/docs/5.6/mix#working-with-stylesheets
// @link https://laravel.com/docs/5.6/mix#sass
// @link https://github.com/sass/node-sass#options

// Sass configuration.
const sassConfig = {
	implementation: require('sass'),
	sassOptions: {
		outputStyle: 'expanded',
		indentType: 'tab',
		indentWidth: 1,
	},
};

// Compile SASS/CSS.
mix.sass(`${devPath}/scss/style.scss`, 'css', sassConfig).sass(
	`${devPath}/scss/editor.scss`,
	'css',
	sassConfig
);

// Add custom Webpack configuration.
//
// Laravel Mix doesn't currently have a built-in method for minimizing images,
// so we're going to use the `CopyWebpackPlugin` instead of `.copy()` for
// processing and copying our images over to their distribution folder.
//
// @link https://laravel.com/docs/5.6/mix#custom-webpack-configuration
mix.webpackConfig({
	stats: 'minimal',
	devtool: mix.inProduction() ? false : 'source-map',
	performance: { hints: false },
	externals: { jquery: 'jQuery' },
	plugins: [
		// @link https://github.com/webpack-contrib/copy-webpack-plugin
		new CopyWebpackPlugin({
			patterns: [
				{ from: `${devPath}/img`, to: 'img' },
				{ from: `${devPath}/svg`, to: 'svg' },
				{ from: `${devPath}/fonts`, to: 'fonts' },
			],
		}),
	],
});

// Monitor files for changes and inject your changes into the browser.
//
// @link https://laravel.com/docs/5.6/mix#browsersync-reloading
mix.browserSync({
	proxy: 'https://syopajatyo.local',
	files: [
		'dist/**/*',
		`${devPath}/views/**/*.php`,
		'app/**/*.php',
		'functions.php',
	],
});
