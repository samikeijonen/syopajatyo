[![Build Status](https://travis-ci.org/samikeijonen/syopajatyo.svg?branch=master)](https://travis-ci.org/samikeijonen/syopajatyo)

# Syopajatyo

Custom theme for [syopajatyo.fi](https://syopajatyo.fi/) site.

Theme is based on [Uuups](https://github.com/samikeijonen/uuups) where you can get more informantion.

## Directory structure

Directory structure aims to be modern app-like, what ever that means :)

- `resources` folder is for editing theme for your needs. This is where the most of the magic happens.
	- `resources/views` have all the template structure and partials files.
	- `resources/scss` have SASS files.
	- `resources/js` have JS files.
	- `resources/img` have all the images.
	- `resources/svg` have SVG icons.
	- `resources/lang` have language files.
- `app` folder is for theme related functions and classes. `*.php` files needs to be added manually via `functions.php`.
- `dist` folder has processed and optimized assets ready to be included to theme. Do not edit or add anything to `dist` folder. It is processed automatically via task tools.

## Installation and setup

Theme uses [Composer](https://getcomposer.org/) and [NPM](https://www.npmjs.com/) to manage its dependencies. Install both on your machine before using this starter theme.

Note that theme has [Hybrid Core 5.0](https://github.com/justintadlock/hybrid-core/tree/5.0) as a must have dependency. This is loaded in the root of the project with `composer install` as other dependencies.

### Install dependencies

Theme lives in the `wp-content/theme/syopajatyo` folder.

```
# Go to the `wp-content/theme/syopajatyo` directory of your WordPress installation.
cd wp-content/themes/syopajatyo
```

#### Install node dependencies using either NPM or Yarn.

**NPM command:**
```
npm install
```

**Yarn command:**
```
yarn install
```

## Build process

This theme utilizes [Laravel Mix](https://laravel.com/docs/5.6/mix) for most of the build process with the theme.

Laravel Mix is a layer built on top of Webpack that makes defining your build process much easier than attempting to write out a custom `webpack.config.js` configuration file.  It simplifies most of the complexity while still allowing you to define custom Webpack config options for more advanced uses.

You may configure the build process to your liking by editing `webpack.mix.js` in the root folder.

The following is a list of commands you can run from the command line:

```
# Processes all of your assets for a development environment.
npm run dev

# Watches for changes to any files and rebuilds for a development environment.
npm run watch

# Watches for changes to files and syncs with the browser using BrowserSync.
npm run hot

# Processes all of your assets for a production environment.
npm run build

# Lint JavaScript and/or SCSS files.
npm run lint
npm run lint:styles
npm run lint:scripts

# Auto-adds a textdomain and/or creates a POT file.
npm run i18n
npm run i18n:textdomain
npm run i18n:pot
```

## Accessibility testing

[Pa11y](https://github.com/pa11y/pa11y) runs your code against [HTML CodeSniffer](http://squizlabs.github.com/HTML_CodeSniffer/). Check documentation from `pa11y` site.

On the command line test any local or live URL:

```
pa11y http://example.com/
```

I recommend also [aXe browser add-on](https://www.deque.com/aXe/) or [aXe-CLI](https://github.com/dequelabs/axe-cli).

More info about [Frontend checks for web accessibility](https://make.wordpress.org/accessibility/handbook/best-practices/test-for-web-accessibility/test-for-web-accessibility-frontend-code/).

## SASS and CSS structure

SASS and CSS structure is probably one of
the biggest aspects of the front-end and theming.
It should have scalable and modular architecture.

Styles are written in `resources/scss` folder.
There are two separate stylesheets
which are automatically compiled to `dist/css`:

- `style.scss` &ndash; Main stylesheet for the theme.
- `editor.scss` &ndash; Stylesheet only for the new editor (Gutenberg).

### Main stylesheet

Main stylesheet `style.scss` follows [ITCSS](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/) approach and [BEM](http://getbem.com/) naming convention.

The main point of ITCSS is that it separates
your CSS codebase to several sections (layers).
It guides you to write CSS from low-specificity selectors to more specific ones.

It also plays nicely with the new editor (Gutenberg)
because block styles can be one of the layers.

We should write separate documentation about SASS and CSS,
it's that important.

### Styles for the editor

`editor.scss` tries to put all the necessary styles
to the new editor.

Note a little trick where we prefix all the styles
with class `edit-post-visual-editor`:

```css
// Editor styles.
.edit-post-visual-editor {
	// Write custom CSS.
	// Or import parts of the SASS.
	// @import "elements/blockquote";
	// @import "elements/hr";
}
```

## New editor (Gutenberg) support

At the moment support for new editor means these things:

- Add support `editor-color-palette` to match theme colors.
- Add support for `align-wide` blocks.
- Dequeue Core block styles.
	- This is because I don't want to overwrite and add too spesific rules to main stylesheet.
	- Core blocks have their own CSS layer as mentioned before. It can be found in `recources/scss/blocks`.
- Get maximum WYSIWYG experience in the editor by
enqueueing block related styles using `enqueue_block_editor_assets` hook.

See previous chapter [styles for the editor](#styles-for-the-editor).

## Template files

We try to avoid having lot's of similar template files
in the root folder. In fact, in root there is only `index.php` template file but that should never be loaded unless plugins do some weird things.

Main fallback template file is found in `resources/views/index.php`.

All the template files are also in `resources/views/` folder. In there template files are
organized in sub-folder using `Hybrid\View\display()` and
`Hybrid\Template\hierarchy` functions.

You could have other top-level templates, like `page.php`, `archive.php`, etc. in the root of `resources/views/` folder and get used like they typically would in theme root. But we try to avoid that also by organizing template files in different folders.

### Hybrid\View\display() function

`Hybrid\View\display()` is Hybrid Core function which is
more powerfull version of `get_template_part()` function. You can for example pass variables to it:

```php
// Hybrid\View\display( $name, $slugs = [], $data = [] )
Hybrid\View\display( 'menu', 'primary', [ 'name' => 'primary' ] );
```

- Above code loads `resources/views/menu/primary.php` file.
- If it doesn't exists it fallbacks to `resources/views/menu/default.php` file.
- And if it doesn't exists it fallbacks to `resources/views/menu.php` file.

Hierarchy looks like this:

```php
// Hybrid\View\display( 'menu', 'primary', [ 'name' => 'primary' ] ) hierarchy.
// 1. resources/views/menu/primary.php
// 2. resources/views/menu/default.php
// 3. resources/views/menu.php
```

The last parameter `[ 'name' => 'primary' ]` is for passing data in to template file. You can access the data like this `$data->name`.

### Hybrid\Template\hierarchy() function

Let's look at example line: `Hybrid\View\display( 'content', Hybrid\Template\hierarchy() );`

This loads template files from `resources/views/content` folder respecting the [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).

```php
// Example hierarchy for single `download` post type.
// 1. resources/views/content/single-download-{slug}.php
// 2. resources/views/content/single-download.php
// 3. resources/views/content/single.php
// 4. resources/views/content/singular.php
// 5. resources/views/content/index.php
// 6. resources/views/index.php
```

## Coding standards and linting

Theme mostly follows [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/). There are couple of things you need to install in your
machine.

1. [Install PHP CodeSniffer](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) to validate code developed for WordPress.
1. [Install PHP Compatibility](https://github.com/wimg/PHPCompatibility) check for PHP CodeSniffer.
1. [Install PHPCS and WPCS to your IDE](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#using-phpcs-and-wpcs-from-within-your-ide).

In `phpcs.xml` there is custom PHP rulesets (sniffs) which are based on Underscores rulesets.

### Run your code automatically through Travis CI

When you commit changes in Github, let [Travis CI](https://travis-ci.org/) run and test your code.

File `.travis.yml` is the configuration file for setting up Travis. It's also based on Underscores configuration.

### Style linting

NPM task `npm run lint:styles` checks SASS files using [stylelint](https://github.com/stylelint/stylelint).

File `.stylelintrc` is the configuration file for stylelint.

I also recommend installing stylelint extension to your IDE, for example [vscode-stylelint](https://marketplace.visualstudio.com/items?itemName=shinnn.stylelint).

### JavaScript linting

NPM task `npm lint:scripts` checks SASS files using [ESLint](https://eslint.org/).

File `.eslintrc.js` is the configuration file for ESLint. And `.eslintignore` file for what files to ignore from linting.

I also recommend installing ESLint extension to your IDE, for example [VS Code ESLint extension](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint).

### Editorconfig

Theme has an `.editorconfig` file that sets your code editor settings accordingly. [Download the extension to your editor](http://editorconfig.org/#download). The settings will automatically be applied when you edit code when you have the extension.

## SVG system

All the main SVG related functions can be found in the `app/functions-svg.php` file. It’s well-documented in the code, but here’s a summary:

- Add SVG icons in `resources/svg` folder. `npm run dev` or `npm run build` copies these SVG files in `dist/svg` folder.
	- In the same cleans them up.
	- Adds attributes and classes for using these icons as decorative only.
- `Syopajatyo\get_svg()` function returns inline SVG icon markup by default.
- For example `Syopajatyo\get_svg( [ 'icon' => 'folder-open' ]`.
- SVG icons are automatically used in Social links menu.
