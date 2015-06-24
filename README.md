# NiceAdminBakeTheme plugin for CakePHP 3

## What is it?
This is a theme for the CakePHP Bake plugin which will customise the templates which are generated. I've made it because 
I don't like the default bake theme, or the fact that it outputs so many options in the actions sidebar.

Plus I tend to use Twitter Bootstrap to make my admin areas so this theme will leverage that front-end framework.

## Installation
You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```bash
composer require 'davidyell/nice-admin-bake-scripts:3.0.x-dev'
```

## Setup
In your `src/config/bootstrap.php` you'll need to load the plugin with `Plugin::load('NiceAdminBakeScripts');`

## Baking
```bash
bin/cake bake template --theme=NiceAdminBakeScripts
```