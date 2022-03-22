<?php

class Application_Http_Request {

    protected $_params;

    public function setParams($params) {
        $this->_params = $params;
        return $this;
    }

    public function getParams() {
        return is_array($this->_params) ? $this->_params : urldecode($this->_params);
    }

    public function param($key) {
        return array_key_exists($key, $this->_params) ? $this->_params[$key] : null;
    }

    public function getRequestMethod() {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getAcceptType() {
        $types = explode(";", $_SERVER["HTTP_ACCEPT"]);
        $options = explode(",", $types[0]);
        return $options[0];
    }

    public function getPost($param = null, $default = null) {
        if(is_null($param)) {
            return filter_input_array(INPUT_POST);
        }
        $data = filter_input(INPUT_POST, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        return (is_null($data) || empty($data)) && $default ?
            $default : trim($data);
    }

    public function getParam($name, $default = null) {
        return isset($_GET[$name]) ? str_replace("'", "`", trim($_GET[$name])) : (isset($_POST[$name]) && $_POST[$name] != "" ? str_replace("'", "`", trim($_POST[$name])) : $default);
    }

    public function setNullIfEmpty($var) {
        if($var == "") {
            return "NULL";
        } else {
            return $var;
        }
    }

    public function isPost() {
        return $this->getRequestMethod() == "post";
    }

    public function getIp() {
        return $_SERVER["REMOTE_ADDR"];
    }

    public function checkRequiredPages(Application_Http_Session $session) {
        if($this->isRedirectAllowed()) {
            $tmp = explode("?", $_SERVER["REQUEST_URI"]);
            $parts = array_filter(explode("/", $tmp[0]));
            $isLogged = $session->getLogged();
			$isTempLogged = $session->getTempLogged();
            if((!$isTempLogged || $isTempLogged != 1) && strtolower($parts[1]) != "verify" && strtolower($parts[1]) != "login") {
                //Application_App::redirect("/login");
            }
    //print_r($isLogged);
            if((!$isLogged || $isLogged == -1) && strtolower($parts[1]) != "login") {
                Application_App::redirect("/login");
            }
        }
    }
    public function getPage() {
        $tmp = explode("?", $_SERVER["REQUEST_URI"]);
        $parts = array_filter(explode("/", $tmp[0]));
        return strtolower($parts[1]);
    }

    public function isRedirectAllowed() {
        if($this->isAjax()) {
            return false;
        }
        return true;
    }

    public function isAjax() {
        $types = array(
            "application/json",
            "application/xml",
            "text/json",
            "text/xml"
        );

        if(in_array($this->getAcceptType(), $types)) {
            return true;
        }

        return false;
    }

}