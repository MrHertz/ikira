<?php
namespace core;

class Autoloader {
	const ALIASES = [
		'core' => '/core/classes/',
		'base' => '/core/base/'
	];

	public static function load($name) {
		$components = explode('\\', $name);
		
		if (isset(self::ALIASES[$components[0]]) && sizeof($components) <= 2) {
			$path = self::ALIASES[$components[0]] . '/' . $components[1] . '.php';
		} else {
			$path = str_replace('\\', '/', $name) . '.php';
		}
		
		if (!file_exists(DIR_ROOT . $path)) { return false; }

		include_once DIR_ROOT . $path;
		return true;
	}

}

?>