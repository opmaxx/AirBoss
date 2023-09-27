# AirBoss site with HTML, CSS and JS

## Tree
``` bash
∟ AirBoss
   ∟ assets
      *all pictures*
   ∟ src
      index.html
      script.js
      style.css
   gsap-bonus.tgz
   readme.md
   webpack.config.js
```

## Setup
- Download [Node.js](https://nodejs.org/en/download/)

- Open terminal in your directory and run :

``` bash
# init the project with Node.js
npm init -y

# Installe dependencies
npm install webpack webpack-cli --save-dev
npm install webpack webpack-dev-server --save-dev
npm install html-webpack-plugin html-loader --save-dev
npm install style-loader css-loader --save-dev
npm install ./gsap-bonus.tgz
npm install gsap --save

# In package.json add or modify
"scripts": {
  "start": "webpack serve --open",
  "build": "webpack"
}
```

## Run the project
``` bash
# Run the local server at localhost:8080
npm start

# Build for production in the dist/directory
npm run build
```
