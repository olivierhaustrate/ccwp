CCWP
====

This is a simple skeleton for quick scaffolding of a WordPress site.
It uses Composer to manage all WP dependencies and comes with a simple multi env wp-config structure. 

Installation
------------

 1. Clone repo 
 2. Edit `composer.json` to fit the needs of your project 
 3. Run `composer install` 
 4. Create a `local-config.php` in `/config` with your DB details 
 5. Visit your new install in your browser in order to complete WordPress' installation
 6. That's it, you're done

Composer.json
-------------
To easy the scaffolding of WordPress sites, the composer.json comes with the following custom packages backed in:

**WP mirror from *John P. Bloch***: https://github.com/johnpbloch/wordpress

> *A fork of WordPress with Composer support added. Branches, tags, and trunk synced from upstream every 15 minutes.*


**Installers from *Composer***: http://composer.github.com/installers

> A Multi-Framework Composer Library Installer.
> It will install WP packages to their correct location based on the specified package type (*wordpress-theme*, *wordpress-plugin*, *wordpress-muplugin*).


**Dropin installer from *Koodimonni***: http://languages.koodimonni.fi/

> This composer plugin helps you to move your composer packaged files where you want them to be. 
> It was  originally created for installing multiple languages for WordPress with composer.


**wp-h5bp-htaccess from *Roots***: https://github.com/roots/wp-h5bp-htaccess

> WordPress plugin that adds HTML5 Boilerplate's .htaccess

Remove this plugin from the `require` list if you are not developing on/for an Apache webserver. 

**modernscores from *Julian Medina***: https://github.com/julianlmedina/Modernscores

> Modernscores is a forked version of Underscores - WordPress starter theme - combined with Sass, the Susy grid system, and Breakpoint.


WordPress Must Use (MU) plugins
-------------------------------

> WordPress Must Use (MU) plugins – by default – must be in the root of the mu-plugins directory. This means that, without any modification, any composer package that is installed into the mu-plugins directory simply won’t work. 

To solve the problem, we've borrowed the **Bedrock Autoloader from *Roots*** : https://github.com/roots/bedrock/ (see `/web/apps/mu-plugins/bedrock-autoloader.php`).