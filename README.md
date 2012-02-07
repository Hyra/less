## UPDATE

I decided to change the LESS component to a Helper, as it feels right and gives you more control.
It fully works with Twitter Bootstrap 2 and have yet to find LESS functionality that doesn't compile.

## What does it do, and why

This little Helper converts your .less files into .css without relying on Node.js or client-side parsing.
Everything is compiled on the server, cached, and served as regular css through PHP.

## Installation

### Get the files in place

Clone from github: in your plugin directory type `git clone https://github.com/Hyra/less.git Less`

### Create cache and less folders

- Create a folder called `less` in `app/webroot/`
- Create a folder called `less` in `app/tmp/cache`
- Apply `chmod 777` to your `css` folder. (The Less Helper will place all compiled css files in your css-directory)

## Usage
Where you want to use LESS files, add the helper. Usually this will be your `AppController`.

	public $helpers = array('Less.Less');

Next, simply add the less files to your views:

	$this->Less->css('yourfile');

This will check if you have a .less file with the same name in your less directory and if so, compile it to css and place it to the css directory

