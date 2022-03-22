<?php

class Application_Misc_Locale {
    private static $_data = array();

    public static function get($var) {
        return self::$_data[$var];
    }

    public static function load($language) {
        $config = new Application_Misc_Config(
            Application_App::getRoot() . '/config/locale/' . strtolower($language) . '.ini');

        self::$_data = $config->read('locale');
    }

    public static function getAll() {
        return self::$_data;
    }
}