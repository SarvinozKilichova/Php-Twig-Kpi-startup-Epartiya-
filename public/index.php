<?php
//print_r('test');
 	error_reporting(E_ALL);
	ini_set("display_errors", 0);
	

    $_root = dirname(__DIR__);
	require $_root . "/code/vendor/autoload.php";
    require_once $_root . "/code/Application/Misc/Autoloader.php";
    $autoload = Autoloader::register($_root . '/code');
    $app = new Application_App($_root);
    $app->init()->run();