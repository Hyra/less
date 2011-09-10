<?php
/**
 * LESS to CSS Converter Component
 *
 * This component checks for .less files insider your lessFolder
 * and converts them on development mode or when the cacheTime expires
 *
 * Relies on the lessc.php class in Vendors
 *
 * PHP versions 4 and 5
 *
 * Mindthecode: http://www.mindthecode.com
 * Copyright 2011, Stef van den Ham
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author        Stef van den Ham
 * @copyright     Copyright 2011, Mindthecode (http://www.mindthecode.com)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::import('Vendor', 'Less.Lessc');
App::import('Core', 'Folder');

class LessComponent extends Object {
	
	/**
	* Customizable options
	**/
	private $lessFolder;
	private $cssFolder;
	private $cacheTime;
	
	/**
	* Startup logic. Sets the options
	* @return void
	* @author Stef van den Ham
	**/
	public function startup() {
		$this->lessFolder = new Folder(ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'less');
		$this->cssFolder = new Folder(ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'css');
		$this->cacheTime = '5 seconds';
	}
	
	/**
	* Main conversion
	* @return void
	* @author Stef van den Ham
	**/
	public function beforeRender() {
		if(!Cache::read('lessed') || Configure::read('debug') > 0) {
			foreach($this->lessFolder->find() as $file) {
				$file = new File($file);
				if($file->ext() == 'less') {
					$lessFile = $this->lessFolder->path . DS . $file->name;
					$cssFile = $this->cssFolder->path . DS . str_replace('.less', '.css', $file->name);
					lessc::ccompile($lessFile, $cssFile);
				}
			}
			Cache::set(array('duration' => $this->cacheTime));
			Cache::write('lessed', time());
		}
	}
	
};