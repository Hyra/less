This little component converts your .less files into .css without relying on Node.js

## Installation

#### Clone
Clone from github: in your plugin directory type `git clone https://github.com/Hyra/less.git less`
#### Submodule
Add as Git submodule: in your plugin directory type `git submodule add https://github.com/Hyra/less.git less`
#### Manual
Download as archive from github and extract to `app/Plugins/Less`

Next, create a folder `less` in `app/webroot/` and apply `chmod 777` to it.

## Usage
In your `AppController.php` add the component:

	public $components = array('Less');

Now every `.less` file from `webroot/less` will be converted to its `.css` equivalent in `webroot/css`

In your `default.ctp` layout you can just use `echo $this->Html->css('your_css_file');` as you always do

## Ignoring files (@importing)
Sometimes you want to use `@import` to combine files, which means you don't want all source .less files to be converted to seperate .css files. That'd be redundant.
Simply prefix your .less files with an underscore (`_yourfile.less`)

## Features

- Conversion happens on every request while in development mode `(debug at 0)`
- Conversion happens every time the cache timer expires, which you can specify in `Controller/Component/LessComponent.php`
- Option to ignore files.