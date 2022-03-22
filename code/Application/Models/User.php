<?php

class Application_Models_User extends Application_Lib_Varien_Object {

    public function login($login, $password) {
        $user_ip = $_SERVER["REMOTE_ADDR"];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $data = $this->getAdapter()->fetch('CALL login(?, ?, ?, ?);', array($login, $password, $user_ip, $user_agent));
        return $data[0];
    }

    public function verify($code) {
        $user_ip = $_SERVER["REMOTE_ADDR"];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $tempcode = $this->getSession()->getTempCode();
        $data = $this->getAdapter()->fetch('CALL verify(?, ?, ?, ?);', array($tempcode, $verify, $user_ip, $user_agent));
        return $data[0];
    }
}