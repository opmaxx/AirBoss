const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
  mode: 'development',
  entry: './src/script.js', // Le point d'entrée de votre application JavaScript
  output: {
    path: path.resolve(__dirname, 'dist'), // Le répertoire de sortie
    filename: 'bundle.js', // Le nom du fichier de sortie
  },
  module: {
    rules: [
      {
        test: /\.html$/, // Appliquer le loader HTML aux fichiers .html
        use: 'html-loader',
      },
      {
        test: /\.css$/, // Appliquer les loaders CSS aux fichiers .css
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: './src/index.html', // Utiliser votre index.html comme modèle
    }),
  ],
};
