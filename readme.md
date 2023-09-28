# Airboss site with Webpack development environment

## Why Webpack ?
The use of Webpack in our front-end development environment for our IoT project is justified by a number of concrete advantages, geared towards the efficiency and optimization of our website construction :
   - Module grouping : Webpack breaks down our source code into modules for clearer management.
   - Minification and Compression : Webpack reduces the size of final files for faster loading times, essential in IoT.
   - Dependency management : Webpack automatically manages dependencies to avoid duplication.
   - Bundling : Webpack groups our source files into a single or multiple production files. This reduces the number of HTTP requests needed to load a page, improving loading speed.

## Tree
``` bash
∟ AirBoss
   ∟ assets
      *all-pictures*
   ∟ src
      contact.html
      index-script.js
      index.html
      login-script.js
      login.html
      style.css
   .gitignore
   gsap-bonus.tgz
   readme.md
   webpack.config.js
```

## Setup
- Download [Node.js](https://nodejs.org/en/download/) and install it
- Open terminal in your directory and run :
``` bash
# Init the project with Node.js
npm init -y

# Install dependencies
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

- Download [WAMP for Windows](https://www.wampserver.com/) and install it
- Go in C:\wamp\bin\apache\apache2.4.9\conf\httpd.conf and change :
``` bash
# Be careful dont write your path with "\" but with "/"
DocumentRoot "your/project/directory"
<Directory "your/project/directory/">
```

## Run the project
``` bash
# Run the local server at localhost:8080
npm start

# Build for production in the dist/directory
npm run build
```