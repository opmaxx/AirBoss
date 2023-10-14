const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
  mode: 'development',
  entry: {
    index: './src/js/index-script.js', // Fichier JavaScript principal
    login: './src/js/login-script.js',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].bundle.js', // Utilisez le nom de l'entrée comme nom de fichier de sortie
  },
  module: {
    rules: [
      {
        test: /\.html$/,
        use: 'html-loader',
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: './src/html/index.html',
      filename: 'index.html',
      chunks: ['index'], // Inclure seulement le JavaScript principal
    }),
    new HtmlWebpackPlugin({
      template: './src/html/login.html',
      filename: 'login.html',
      chunks: ['login'], // Inclure uniquement le JavaScript pour page1
    }),
    new HtmlWebpackPlugin({
      template: './src/html/contact.html',
      filename: 'contact.html',
    }),
    new HtmlWebpackPlugin({
      template: './src/html/control-panel.html',
      filename: 'control-panel.html',
    }),
  ],
};
