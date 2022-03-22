<?php

class Application_Misc_ModelLoader {

    public function __construct(Application_Http_Session $session,
        Application_Misc_Config $config, $adapter) {

        $this->_session = $session;
        $this->_config = $config;
        $this->_adapter = $adapter;
    }

    public function load($modelName) {
        $model = $this->getModelInstance($modelName);

        if($model instanceof Application_Lib_Varien_Object) {

            $model->setSession($this->_session)
                ->setConfig($this->_config)
                ->setAdapter($this->_adapter);

        }
        return $model;
    }

    private function getModelInstance($modelClass = '')
    {
        $className = $this->getModelClassName($modelClass);
        if (class_exists($className)) {
            $obj = new $className();
            return $obj;
        } else {
            return false;
        }
    }

    private function getModelClassName($modelClass)
    {
        $modelClass = trim($modelClass);
        $prefix = 'Application_Models_';

        if (strpos($modelClass, DIRECTORY_SEPARATOR)===false) {
            $name = $prefix . ucfirst($modelClass);
        } else {
            $name = $prefix . str_replace(' ', '_', ucwords(str_replace(DIRECTORY_SEPARATOR, ' ', $modelClass)));
        }
        return $name;
    }

} 