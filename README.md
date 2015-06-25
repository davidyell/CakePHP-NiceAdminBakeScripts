# Nice Admin Bake Theme
A custom theme using Twitter Bootstrap to bake admin templates in [CakePHP 3](https://github.com/cakephp/cakephp), 
using the [CakePHP Bake](https://github.com/cakephp/bake) plugin.

## Requirements
* CakePHP 3
* PHP 5.4.16+

## What is it?
This is a theme for the [CakePHP/Bake plugin](https://github.com/cakephp/bake) which will customise the code which is 
generated. I've made it because I don't like the default bake theme, or the fact that it outputs the actions sidebar.

Plus I tend to use [Twitter Bootstrap](http://getbootstrap.com/) to make my admin areas so this theme will 
leverage that front-end framework.

## Installation
You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is using, 

```bash
composer require 'davidyell/nice-admin-bake-scripts:3.0.x-dev'
```

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

## Optional extras
If you want to use Twitter Bootstrap for all your forms also you can install the [friendsofcake/bootstrap-UI](https://github.com/friendsofcake/bootstrap-ui).

This can be easily coupled with the [friendsofcake/crud plugin](https://github.com/friendsofcake/crud) to pretty much make
an entire basic admin in around 5 minutes!

A basic stylesheet is included to fix some minor things. You can add it to your layout 
using `$this->Html->style('NiceAdminBakeTheme.nice-admin')`. However it's much better to symlink the stylesheet into your 
own `webroot/css` and include it from there.

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

## Changes to standard bake
* Removed the `_serialize` from the controllers
* Removed the actions sidebar from all templates
* Formatted tables with Bootstrap
* Added a 'New' button to the top of tables
* Tidied up the pagination
* Made the Actions column links into buttons
* Added handling for date, datetime and time using the Time helper
* Added handling for boolean data using Bootstrap icons
* Updated the View template to use Bootstrap panels

# License
A custom cakephp/bake theme for generating customised cakephp code and templates. 

Copyright (C) 2015  David Yell

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
