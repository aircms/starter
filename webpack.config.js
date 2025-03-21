const path = require('path');

module.exports = {
  entry: './app/ui/js/main.js',
  output: {
    filename: 'build.js',
    path: path.resolve('www/assets/ui'),
  },
  mode: 'production',
  module: {
    rules: [
      {test: /\.html/, use: 'html-loader'}
    ],
  },
};