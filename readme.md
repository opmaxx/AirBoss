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
         control-panel.html
         index.html
         login.html
      ∟ js
         index-script.js
         index.bundle.js
         login-script.js
      ∟ php
         config.inc.php
         exemple_adding_data.php
         login.php
         register.php
   readme.md
```

## Create a localhost server
- Download [WAMP for Windows](https://www.wampserver.com/) or [LAMP for Linux](https://doc.ubuntu-fr.org/lamp) or [MAMP for Mac](https://www.mamp.info/en/mac/) and install it

- Open WAMP or LAMP or MAMP, launch phpMyAdmin and create a table with this tree :
``` bash
∟ airboss_data
   ∟ user_data
      username
      email
      password
   ∟ user_request
      email
      request
   ∟ parameters
      *in-development*
```

## Useful link for PHP development
- Prevent SQL injection : [Codeur tuto](https://www.codeur.com/tuto/php/se-proteger-injections-sql/)
- Encode and decode URL : [PHP Manual](https://www.php.net/manual/fr/function.base64-encode.php)
- Base of PHP and MySQL : [Openclassrooms](https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql)
- You will find some examples of PHP script in AirBoss/src/php/