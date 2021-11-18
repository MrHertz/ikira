<?php
namespace core;

class Errors {
	public static function new($msg, $redirect = false) {
		echo $msg;
		$redirect && exit();
	}
}

?>