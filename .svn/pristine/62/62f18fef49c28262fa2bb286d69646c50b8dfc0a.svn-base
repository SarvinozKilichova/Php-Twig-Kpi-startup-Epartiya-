<?php

class Autoloader {

	protected static $_sourceDir = '';

	public static function register($sourceDir = '', $prepend = false) {
        if (version_compare(phpversion(), '5.3.0', '>=')) {
            spl_autoload_register(array(__CLASS__, 'autoload'), true, $prepend);
        } else {
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
        self::$_sourceDir = $sourceDir;
    }

	public static function autoload($class) {
        $file = self::$_sourceDir. DIRECTORY_SEPARATOR. str_replace(array('_', "\0"), array('/', ''), $class).'.php';

        if (is_file($file)) {
            require_once $file;
        }
    }

	public static function unregister() {
		spl_autoload_unregister(array(__CLASS__, 'autoload'));
	}
}