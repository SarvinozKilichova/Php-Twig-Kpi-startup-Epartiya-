<?php

class Application_Http_Session {

    private static $_underscoreCache = array();

    public function __construct($init = true) {
        if($init) {
            session_start();
        }
    }

    public function isLoggedIn() {
        return $this->getLogged() == 1;
    }

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
                $data = $this->getData($key, isset($args[0]) ? $args[0] : null, isset($args[1]) ? $args[1] : null);
                return $data;

            case 'set' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->setData($key, isset($args[0]) ? $args[0] : null);
                return $result;

            case 'uns' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->unsetData($key);
                return $result;

            case 'has' :
                $key = $this->_underscore(substr($method,3));
                return isset($_SESSION[$key]);
        }
        throw new Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");
    }

    public function setData($key, $value = null)
    {
        if(is_array($key)) {
            $_SESSION = $key;
        } else {
            $_SESSION[$key] = $value;
        }
        return $this;
    }

    public function unsetData($key = null)
    {
        if (is_null($key)) {
            $_SESSION = array();
        } else {
            unset($_SESSION[$key]);
        }
        return $this;
    }

    public function getData($key = '', $index=null, $default=null)
    {
        if ('' === $key) {
            return $_SESSION;
        }

        //$default = null;

        // accept a/b/c as ['a']['b']['c']
        if (strpos($key,'/')) {
            $keyArr = explode('/', $key);
            $data = $_SESSION;
            foreach ($keyArr as $i => $k) {
                if ($k === '') {
                    return $default;
                }
                if (is_array($data)) {
                    if (!isset($data[$k])) {
                        return $default;
                    }
                    $data = $data[$k];
                } else {
                    return $default;
                }
            }
            return $data;
        }

        // legacy functionality for $index
        if (isset($_SESSION[$key])) {
            if (is_null($index)) {
                return $_SESSION[$key];
            }

            $value = $_SESSION[$key];
            if (is_array($value)) {
                //if (isset($value[$index]) && (!empty($value[$index]) || strlen($value[$index]) > 0)) {
                /**
                 * If we have any data, even if it's empty - we should use it, anyway
                 */
                if (isset($value[$index])) {
                    return $value[$index];
                }
                return null;
            } elseif (is_string($value)) {
                $arr = explode("\n", $value);
                return (isset($arr[$index]) && (!empty($arr[$index]) || strlen($arr[$index]) > 0))
                    ? $arr[$index] : null;
            }

            return $default;
        }
        return $default;
    }

    public function purge() {
        $_SESSION = array();
        session_destroy();
        if(isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $key = trim($parts[0]);
                if ($key!='userlogin') {
                    setcookie($key, '', time()-60*60*24*30);
                    setcookie($key, '', time()-60*60*24*30, '/');
                    setcookie($key, '', time()-60*60*24*30, '/monitoring/');
                }
            }
        }
        return $this;
    }

    protected function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }

        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));

        self::$_underscoreCache[$name] = $result;
        return $result;
    }
} 