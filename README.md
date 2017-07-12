# Nice Admin Bake Theme
A custom theme using Twitter Bootstrap to bake admin templates in [CakePHP 3](https://github.com/cakephp/cakephp), 
using the [CakePHP Bake](https://github.com/cakephp/bake) plugin.

## Requirements
* CakePHP 3
* PHP 5.6+

## What is it?
This is a theme for the [CakePHP/Bake plugin](https://github.com/cakephp/bake) which will customise the code which is 
generated. I've made it because I don't like the default bake theme, or the fact that it outputs the actions sidebar.

Plus I tend to use [Twitter Bootstrap](http://getbootstrap.com/) to make my admin areas so this theme will 
leverage that front-end framework.

## Installation
You should install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is using, 

```bash
composer require davidyell/nice-admin-bake-scripts
```

## Setup
In your `config/bootstrap.php` you'll need to load the plugin with `Plugin::load('NiceAdminBakeTheme');`

In your admin layout, you'll need to include the theme and javascript if you're using [Twitter Bootstrap](http://getbootstrap.com/). This snippet also includes [jQuery](http://jquery.com/), so if you've already loaded that, please remove that line.

```php
// In the head of your layout
<?= $this->Html->css([
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css'
]) ?>

// Before your script block
<?= $this->Html->script([
    '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'
]);?>
```

## Optional extras
If you want to use Twitter Bootstrap for all your forms be sure to enable [friendsofcake/bootstrap-UI](https://github.com/friendsofcake/bootstrap-ui) 
in your application and loading the helpers in your `src/View/AppView.php`. [Find out more about installing bootstrap-ui in their readme](https://github.com/friendsofcake/bootstrap-ui).

This can be easily coupled with the [friendsofcake/crud plugin](https://github.com/friendsofcake/crud) to pretty much make
an entire basic admin in around 5 minutes!

A basic stylesheet is included to fix some minor things. You can symlink the stylesheet into your own `webroot/css` and include it from there, using

```bash
$ bin/cake plugin assets symlink NiceAdminBakeTheme
```

Of if you want to create the link manually `cd webroot/css && ln -s ../../vendor/davidyell/nice-admin-bake-scripts/webroot/css/nice-admin.css`.

## Baking
The theme should be available when you are baking. You can check this by just running a bake command with `-h` and 
checking the available themes listed in the `--theme` option help. If you don't see it [make sure you've loaded the plugin](#setup).

### Controllers
```bash
bin/cake bake controller --theme=NiceAdminBakeTheme Examples
```

### Templates
```bash
bin/cake bake template --theme=NiceAdminBakeTheme Examples
```

### Prefixed templates
```bash
bin/cake bake template --theme=NiceAdminBakeTheme --prefix=Admin Examples
```

## Example layout, elements and dashboard
A basic admin layout, dashboard and navigation elements are included in the plugin. Which you can symlink, extend, or 
copy into your project as you see fit.

If you want to link to the styles. `echo $this->Html->css(['nice-admin']);`

However it's preferable to use a symlink.
```bash
$ bin/cake plugin assets symlink NiceAdminBakeTheme
```

:warning: These elements are optional, and do not provide a completed admin. You will need to customise 
this to suit your needs.

## Changes to standard bake
* Removed the `_serialize` from the controllers
* Removed the actions sidebar from all templates
* Formatted tables with Bootstrap
* Added a 'New' button to the top of tables
* Add basic filter form to index templates
* Tidied up the pagination
* Made the Actions column links into buttons
* Added handling for date, datetime and time using the Time helper
* Added handling for boolean data using Bootstrap icons
* Updated the View template to use Bootstrap panels
* Spaced out the Table definition functions
* Added classes to the columns in index templates
* Lists are now ordered
* Index pagination is done with a query

# License
[See license.md](LICENSE.md)
