import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

document.addEventListener("chartjs:init", (event) => {
	const Chart = event.detail.Chart;

	Chart.register({
		id: "css-variables",
		beforeInit(chart, args, options) {
			const computedStyle = window.getComputedStyle(document.documentElement);

			for (const dataset of chart.data.datasets) {
				if (dataset.backgroundColor) {
					dataset.backgroundColor = dataset.backgroundColor.map((color) => {
						if (color.startsWith("var(--")) {
							return computedStyle.getPropertyValue(color.slice(4, -1));
						}

						return color;
					});
				}
			}
		},
	});
});
