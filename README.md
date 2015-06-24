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

## Optional extra
If you want to use Twitter Bootstrap for all your forms also you can [install the FriendsOfCake/Bootstrap-UI](https://github.com/friendsofcake/bootstrap-ui).

## Setup
In your `src/config/bootstrap.php` you'll need to load the plugin with `Plugin::load('NiceAdminBakeTheme');`

In your admin layout, you'll need to include the theme and javascript.

```php
<?= $this->Html->css([
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css'
]) ?>


<?= $this->Html->script([
    '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'
]);?>
```

## Baking
```bash
bin/cake bake template --theme=NiceAdminBakeTheme
```
