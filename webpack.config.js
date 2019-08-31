const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

let hasSourceMaps = true;

module.exports = {
  entry: {
    "main": [
      "./script/main.js",
      "./styles/style.scss"
    ],
    "admin-trail": [
      "./script/trail.js",
      "./styles/admin/trail.scss"
    ],
    "admin-trail-options": [
      "./script/options.js"
    ],
    "customizer": [
      "./script/customizer.js"
    ],
    "frontpage": [
      "./script/frontpage.js"
    ]
  },
  output: {
    filename: 'assets/script/[name].js',
    path: path.resolve(__dirname, 'dist')
  },
  context: path.join(__dirname, 'src'),
  devtool: "source-map",
  module: {
    rules: [
      {
        test:  /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: hasSourceMaps
            }
          },
          {
            loader: 'postcss-loader', // Run post css actions
            options: {
              plugins: function () { // post css plugins, can be exported to postcss.config.js
                return [
                  require('precss'),
                  require('autoprefixer')
                ];
              },
              sourceMap: hasSourceMaps
            }
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: hasSourceMaps
            }
          }
        ]
      },
      {
        test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: "url-loader?limit=10000&mimetype=application/font-woff&name=assets/fonts/[name].[ext]"
      },
      {
        test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: "file-loader?name=assets/fonts/[name].[ext]"
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin(),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: ['popper.js', 'default']
    }),
    new MiniCssExtractPlugin({
      moduleFilename: ({name}) => {
        return {
          'main': 'style.css',
          'admin-trail': 'assets/styles/admin-trail.css'
        }[name];
      },
    }),
    new CopyWebpackPlugin([
        { context: 'php', from:'**/*'},
        { context: 'static', from:'**/*'},
    ])
  ],
  externals: {
    jquery: 'jQuery',
    wordpress: 'wp',
  }
};
