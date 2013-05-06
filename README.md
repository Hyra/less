## LESS Helper

This little Helper converts your .less files into .css without relying on Node.js or client-side parsing.
Everything is compiled on the server, cached, and served as regular css through PHP.

## Installation

### Get the files in place

#### Git submodule

If you are developing your application with Git already, you can install the plugin as a submodule. In your git base folder type

    git submodule add https://github.com/Hyra/less.git app/Plugin/Less

#### Git clone

In your plugin directory type

    git clone https://github.com/Hyra/less.git Less

### Initialize lessphp submodule and download files

In the plugin folder ('app/Plugins/Less') type

    git submodule init
    git submodule update

### Create cache and less folders

- Create a folder called `less` in `app/webroot/`
- Create a folder called `less` in `app/tmp/cache`
- Apply `chmod 777` to your `css` folder. (The Less Helper will place all compiled css files in your css-directory)

## Usage
Where you want to use LESS files, add the helper. Usually this will be your `AppController`.

	public $helpers = array('Less.Less');

Next, simply add the less files to your views:

	echo $this->Less->css('yourfile');

or if the less file is located in the webroot of a plugin

	echo $this->Less->css('yourfile',array('plugin' => 'PluginFolderName'));
	
or
	
	echo $this->Less->css(array(
			'bootstrap/bootstrap',
			'prettify',
		)
	);

It doesn't matter if you link to stolen .css files directly, the Helper will check for the existance of a .less version first, and fall back if it doesn't find one.

If it does find a corresponding .less file with the same name in your less directory, it will compile it to css and place it in your css directory

