<?php

class Application_Http_Dispatcher {
    protected $_serviceKey;
    protected $_uriParams;
    protected $_parts;

    public function dispatch($default_service, $loggedIn) {
        $tmp = explode('?', $_SERVER['REQUEST_URI']);
        $this->_parts = $parts = array_filter(explode('/', $tmp[0]));
        $key   = null;
        $this->_uriParams = array();
        $this->_serviceKey = $this->_parts[1];
        array_shift($parts);

        foreach($parts as $part) {
            if(is_null($key)) {
                $key = $part;
                continue;
            }

            $this->_uriParams[$key] = $part;
            $key = null;
        }

        if(!is_null($key)) {
            $this->_uriParams[$key] = null;
            $this->_isList = true;
        } else {
            $this->_isList = false;
        }

        if(empty($this->_serviceKey)) {
            $this->_serviceKey = $default_service;
        }
        
        if(!$loggedIn && strtolower($parts[1]) != 'login') {
            $this->_serviceKey = 'login';
        }
		
        return $this;
    }

    public function getAction() {
        return empty($this->_parts[2]) ? 'index' : $this->_parts[2];
    }

    public function getServiceKey() {
        return $this->_serviceKey;
    }

    public function getParts() {
        return $this->_parts;
    }

    public function getUriParams() {
        return $this->_uriParams;
    }
} 