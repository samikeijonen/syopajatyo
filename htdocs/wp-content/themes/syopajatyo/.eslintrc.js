module.exports = {
	root: true,
	extends: ['plugin:@wordpress/eslint-plugin/recommended'],
	parserOptions: {
		requireConfigFile: false,
		babelOptions: {
			presets: [require.resolve('@wordpress/babel-preset-default')],
		},
	},
	rules: {
		// Number 1 means warning.
		'@wordpress/no-unused-vars-before-return': 1,
		// Number 1 means disabling.
		'react-hooks/rules-of-hooks': 0,
	},
};
