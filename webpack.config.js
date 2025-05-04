const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
  ...defaultConfig,
  entry: {
    // sidebar UI.
    'sidebar-panel': './editor/index.js',

    // editor + save for block.
    'project-slider-block': './blocks/timeline-slider/index.js',

    // front‑end initializer (imports slick or uses CDN).
    'project-slider-frontend': './blocks/timeline-slider/frontend.js',
  },
  output: {
    ...defaultConfig.output,
    filename: '[name].js',
  },
};
