const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

module.exports = {
  entry: {
    "main": [
      "./script/main.js",
      "./styles/style.scss"
    ],
    "customizer": [
      "./script/customizer.js"
    ]
  },
  output: {
    filename: 'script/[name].js',
    path: path.resolve(__dirname, 'dist')
  },
  context: path.join(__dirname, 'src'),
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
            fallback: 'style-loader',
            use: [
            'css-loader',
            {
              loader: 'postcss-loader', // Run post css actions
              options: {
                plugins: function () { // post css plugins, can be exported to postcss.config.js
                  return [
                    require('precss'),
                    require('autoprefixer')
                  ];
                }
              }
            },
            'sass-loader'
          ]
        })
      },
      {
        test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: "url-loader?limit=10000&mimetype=application/font-woff&name=fonts/[name].[ext]"
      },
      {
        test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: "file-loader?name=fonts/[name].[ext]"
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin(['dist/*']), /* Do not remove the top-level directory, or docker will loose the dynamic link to the virtual installation */
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: ['popper.js', 'default']
    }),
    new ExtractTextPlugin("style.css"),
    new CopyWebpackPlugin([
        { context: 'php', from:'**/*'},
        { context: 'static', from:'**/*'},
    ])
  ]
};
