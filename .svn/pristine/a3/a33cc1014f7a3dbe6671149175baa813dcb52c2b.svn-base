<?php

class Application_Database_Factory {
    public function getAdapter(Application_Misc_Config $config, $dev = false) {
        $db = $config->read('db'. $dev);
        $driver = 'Application_Database_Adapters_'. $db['driver'];
        return new $driver($config->read('db'. $dev));
    }
} 