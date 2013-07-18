#CakePHP-NiceAdminBakeScripts

My bake scripts for generating admins.

##Version
This is kinda under semi-active development. I'm hoping to make them clever enough to make the components and such conditional.

##Requirements
These scripts will make some assumptions about your setup, along with the plugins and components that you're using.  

* [CakeDC/Utils](https://github.com/cakedc/utils) - SoftDeletable specifically  
* [davidyell/NiceAdmin](https://github.com/davidyell/CakePHP-NiceAdmin) - For the helpers used in the baked views  

##Usage
Be sure to include the plugin in your `app/Config/bootstrap.php`.  

`CakePlugin::load('NiceAdminBakeScripts');` unless you are using `CakePlugin::loadAll()`   

`cake bake` inside your `/app` folder. Then you can select the `NiceAdmin` theme when asked which theme you'd like to use.

##TODO  

* Make views aware of Behaviours such as SoftDelete to make button display conditional
* Allow views to detect field type and automatically use the `Boolean` helper
