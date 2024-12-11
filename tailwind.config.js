/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
	theme: {
		extend: {
			fontFamily: {
				sans: [
					'"Inter var", "ui-sans-serif", "system-ui", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI", "Symbol", "Noto Color Emoji"',
					{
						fontFeatureSettings: '"cv02","cv03","cv04","cv11"',
					},
				],
			},
		},
	},
	plugins: [],
};
