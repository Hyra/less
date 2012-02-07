<?php
/**
 * LESS to CSS Converter Plugin
 *
 * This plugin compiles your .less files to regular CSS withouth relying on
 * client- or serverside JavaScript
 *
 * Relies on the lessc.php class in Vendor
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

App::uses('AppHelper', 'View/Helper');
App::uses('HtmlHelper', 'View/Helper');

App::uses('lessc', 'Less.Vendor');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Component', 'Controller');

class LessHelper extends HtmlHelper {
	
	public function __construct($options = null) {
		$this->lessFolder = new Folder(ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'less');
		$this->cssFolder = new Folder(ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'css');
		$this->cacheTime = '5 seconds';
	}
	
	public function css($file) {
		if(is_array($file)) {
			foreach($file as $candidate) {
				$source = $this->lessFolder->path . DS . $candidate . '.less';
				if(file_exists($source)) {
					$target = str_replace('.less', '.css', str_replace($this->lessFolder->path, $this->cssFolder->path, $source));
					$this->auto_compile_less($source, $target);
				}
			}
		}
		echo parent::css($file);
	}

	public function auto_compile_less($less_fname, $css_fname) {
		// Check if cache is writable
		if(!is_writable(CACHE . 'less')) {
			echo '<span class="notice">';
			echo __d('cake_dev', 'Your app/tmp/cache/less directory is NOT writable.');
			echo '</span>';
		}
		
		// load the cache
		$cache_fname = CACHE . 'less' . DS . str_replace('/', '_', str_replace($this->lessFolder->path, '', $less_fname).".cache");
		
		if (file_exists($cache_fname)) {
			$cache = unserialize(file_get_contents($cache_fname));
		} else {
			$cache = $less_fname;
		}
		
		$new_cache = lessc::cexecute($cache);
		if (!is_array($cache) || $new_cache['updated'] > $cache['updated']) {
			file_put_contents($cache_fname, serialize($new_cache));
			file_put_contents($css_fname, $new_cache['compiled']);
		}
	}

};