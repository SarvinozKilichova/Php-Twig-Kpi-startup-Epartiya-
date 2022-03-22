<?php

class Application_Models_Index extends Application_Lib_Varien_Object {

    public function getAllCount() {
        $data =  $this->getAdapter()->fetchAll('CALL getcountmes(?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod() , $this->getSession()->getRole(), $this->getSession()->getLastEnter()));
        	$this->getSession()->setLastEnter(date("Y-m-d H:i:s"));
       	return $data;
    }

    public function getDist($id = '', $code = '') {
    	$data  = $this->getAdapter()->fetch('SELECT name FROM districts WHERE regions_code = IF("'.$code.'" = "", "'.$id.'", (SELECT id FROM regions WHERE code = "'.$code.'")) order by dis_code;');
    	return $data;
    }

    public function getChart() {
    	return $this->getAdapter()->fetchAll('CALL getCount(?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod() ));
    }

    public function getBPT($tcode) {
    	return $this->getAdapter()->fetch('SELECT id, bptname FROM bpt WHERE status=1 AND kcode  = "'.$this->getSession()->getKenCod().'" AND  tcode = "'.$tcode.'";');
    }

    public function getKengash() {
        return $this->getAdapter()->fetch('Adolat_SDP_Kengash ? ', array($this->getSession()->getKenCod()));
    }

    public function doubleAuth($method, $email, $telegramId) {
     	$data = $this->getAdapter()->fetch('CALL doubleAuth(?, ?, ?, ?);', array($this->getSession()->getSesskey(),$method, $email, $telegramId));
      	return $data[0];
    }

    public function changepass($oldpass, $newpass) {
    	$user_ip = $_SERVER["REMOTE_ADDR"];
     	$data = $this->getAdapter()->fetch('CALL changepass(?, ?, ?, ?);', array($this->getSession()->getSesskey(), $oldpass, $newpass, $user_ip));
      	return $data[0];
    }

  	public function getSettings() {
     	$data = $this->getAdapter()->fetchAll('SELECT dl, email, telegramId FROM users WHERE sesskey =  "'.$this->getSession()->getSesskey().'"; SELECT * FROM message');
      	return $data;
    }

    public function getUsers($params = array()) {
	    array_unshift($params, $this->getSession()->getSesskey());
		array_push($params);
    	$data = $this->getAdapter()->fetchAll('CALL getUsers (?, ?, ?, ?);', $params);
    	return $data;
    }

    public function editpass($id, $newpass) {
    	$user_ip = $_SERVER["REMOTE_ADDR"];
     	$data = $this->getAdapter()->fetch('CALL editPass(?, ?, ?, ?);', array($this->getSession()->getSesskey(), $id,  $newpass, $user_ip));
      	return $data[0];
    }

    public function addusers($kname, $regions, $districts,  $login, $newpass, $status) {
     	$data = $this->getAdapter()->fetch('CALL addusers(?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$kname, $regions, $districts, $login, $newpass, $status));
      	return $data[0];
    }

    public function deluser($id) {
     	$data = $this->getAdapter()->fetch('DELETE FROM users WHERE id = "'.$id.'" ');
      	return '1';
    }

    public function delDis($id) {
 		$data = $this->getAdapter()->fetch('DELETE FROM districts WHERE id = "'.$id.'" ');
  		return '1';
    }

    public function editDis($id, $name) {
   		$data = $this->getAdapter()->fetch('UPDATE districts SET name = "'.$name.'" WHERE id ="'.$id.'";');
   		return '1';
    }

    public function addDis($name, $region) {
   		$data = $this->getAdapter()->fetch('CALL addDis(?, ?, ?);', array($this->getSession()->getSesskey(),$name, $region));
      	return $data[0];
    }
    public function changeStatus($id) {
   		$data = $this->getAdapter()->fetch('CALL changeStatus(?, ?);', array($this->getSession()->getSesskey(),$id));
      	return $data[0];
    }

    public function addmes($ken, $type, $one, $durdate, $durtime, $text) {
   		$data = $this->getAdapter()->fetch('INSERT INTO message (ken, type, one, durdatetime, text, insert_datetime) VALUES ("'.$ken.'", "'.$type.'", "'.$one.'", "'.$durdate.' '.$durtime.'", "'.$text.'", now());');
      	return '1';
    }

    public function delmes($id) {
 		$data = $this->getAdapter()->fetch('DELETE FROM message WHERE id = "'.$id.'" ');
  	return '1';
    }   


}