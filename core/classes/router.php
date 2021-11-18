<?php
namespace core;

class Router {
	const DEFAULT_CONTROLLER = 'main';
	const DEFAULT_ACTION = 'index';

	private static $uri_arr = null;

	private static function parse_uri() {
		if (self::$uri_arr !== null) return;
		$components = explode('/', explode("?", $_SERVER['REQUEST_URI'])[0]);

		self::$uri_arr = array_slice($components, 1);
	}

	public static function get_uri_param($n) {
		self::parse_uri();
		if (isset(self::$uri_arr[$n]))
			return self::$uri_arr[$n];
		return false;
	}

	public static function load($controller, $action) {
		$controller = 'app\controllers\controller_' . strtolower($controller);
		$action = 'action_' . strtolower($action);

		if (!class_exists($controller)) {
			Errors::new('Controller not found!', 404);
			return false;
		} 

		$ctrl = new $controller;

		if (!method_exists($ctrl, $action)) {
			Errors::new('Action not found!', 404);
			return false;
		}

		$ctrl->$action();
		echo $ctrl->getResponse(true);
	}

	public static function run() {
		$controller = self::get_uri_param(0) ? self::get_uri_param(0) : self::DEFAULT_CONTROLLER;
		$action = self::get_uri_param(1) ? self::get_uri_param(1) : self::DEFAULT_ACTION;
		self::load($controller, $action);
	}
}

?>