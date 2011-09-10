This little component converts your .less files into .css without relying on Node.js

## Installation

#### Clone
Clone from github: in your plugin directory type `git clone git@github.com:Hyra/CakePHP-LessCss.git less`
#### Submodule
Add as Git submodule: in your plugin directory type `git submodule add git@github.com:Hyra/CakePHP-LessCss.git less`
#### Manual
Download as archive from github and extract to `app/plugins/less`

Next, create a folder `less` in `app/webroot/` and apply `chmod 777` to it.

## Usage
In your `app_controller.php` add the component:

	public $components = array('Less.Less');

Now every `.less` file from `webroot/less` will be converted to its `.css` equivalent in `webroot/css`

## Features

- Conversion happens on every request while in development mode `(debug at 0)`
- Conversion happens every time the cache timer expires, which you can specify in `controllers/components/less.php`