# AirBoss site with HTML, CSS, JS, PHP and MySQL

## Tree
``` bash
∟ AirBoss
   ∟ assets
      *all-pictures*
   ∟ src
      ∟ css
         style-bundle.css
         style-page.css
      ∟ html
         contact.html
         index.html
         login.html
      ∟ js
         index-script.js
         index.bundle.js
         login-script.js
         update-script.js
      ∟ php
         config.inc.php
         contact-form-process.php
         control-panel.php
         login.php
         register.php
         update-chart-humidity.php
         update-chart-temperature.php
         update-open.php
         update-water.php
   readme.md
```

## Create a localhost server
- Download [WAMP for Windows](https://www.wampserver.com/) or [LAMP for Linux](https://doc.ubuntu-fr.org/lamp) or [MAMP for Mac](https://www.mamp.info/en/mac/) and install it
- Go in C:\wamp\bin\apache\apache2.4.9\conf\httpd.conf and change :
``` bash
# Be careful dont write your path with "\" but with "/"
DocumentRoot "your/project/directory"
<Directory "your/project/directory/">
```

- Open WAMP or LAMP or MAMP, launch phpMyAdmin and create a table with this tree :
``` bash
∟ airboss_data
   ∟ commands
      id
      water
      open
      warning
   ∟ parameters
      humidity
      temperature
      battery
      timestamp
   ∟ user_data
      username
      email
      password
   ∟ user_request
      email
      request
```

## Useful link for PHP development
- Prevent SQL injection : [Codeur tuto](https://www.codeur.com/tuto/php/se-proteger-injections-sql/)
- Hashing password in the database : [PHP documentation](https://www.php.net/manual/en/function.password-hash.php)