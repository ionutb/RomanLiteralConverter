Roman Literal Converter
=======================

Introduction
------------
This web app is a programme that converts a number into a Roman Numeral.
It uses Zend Framework 2 and was writen as a TDD experiment.
It runs on both Windows and Unix environments on Apache and IIS.

Installation
---------------------------

1. Clone the github repository

`git clone https://github.com/ionutb/RomanLiteralConverter.git`

2. Cd into the directory and use [Composer](https://getcomposer.org/) to install dependencies

`    composer install`


Web server setup
----------------

### Apache setup

To setup apache, setup a virtual host to point to the public directory of the
project. 

    <VirtualHost *:80>
        ServerName roman.localhost
        DocumentRoot /path/to/app/public
        <Directory /path/to/app/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
            <IfModule mod_authz_core.c>
            Require all granted
            </IfModule>
        </Directory>
    </VirtualHost>
**Caveat**: you need to enable mod_rewrite:
`a2enmod rewrite`
`/etc/init.d/apache2 restart`

### IIS setup

Simply create a new site and set its physical address to the public directory of the
project. 

**Caveat**: You need to enable [Url Rewrite](http://www.iis.net/learn/extensions/url-rewrite-module/using-the-url-rewrite-module)

Testing
---------------------------
Unit tests are located in \RomanLiteralConverter\module\Converter\test

You need to download  [PHP Unit](https://phpunit.de/) and run the utilty in the above path. 

`cd <path_to_app>`

`phpunit`
