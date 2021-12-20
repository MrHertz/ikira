<?php
use core\router;

define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
define('APP', true);

include DIR_ROOT . '/Core/Classes/Errors.php';
include DIR_ROOT . '/Core/Classes/Autoloader.php';

spl_autoload_register('core\Autoloader::load');

Router::run();

/*pep from aacer*/
?>