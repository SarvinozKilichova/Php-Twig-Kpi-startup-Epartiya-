<?php

class Application_Models_Ilova extends Application_Lib_Varien_Object {

	public function getIlova($i, $begin_date, $end_date, $page='1', $limit='50') {
		$data = $this->getAdapter()->fetchAll('CALL getIlova(?, ?, ?, ?, ?, ?, ?, ?, ?);', array(
		    $this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod(), $this->getSession()->getRole(), $i, $begin_date, $end_date, $page, $limit));
		return $data;
	}

    public function getKen_iq() {
        $data = $this->getAdapter()->fetch('CALL getKen_iq (?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod()));
    	return $data;
    }
  
    public function getKen_tar() {	
        $data =  $this->getAdapter()->fetch('CALL getKen_tar (?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod()));
        return $data;
    }
     public function getKen_aqt() {    	
        return $this->getAdapter()->fetch('CALL getKen_aqt (?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod()));
    }
    public function getKen_yqt() {    	
        return $this->getAdapter()->fetch('CALL getKen_yqt (?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod()));
    }

    public function addKen_tar($fname, $mname, $lname, $tdate, $work, $level, $organ, $sdate, $yun, $address, $tel, $email){
    	$data = $this->getAdapter()->fetchAll('CALL addKen_tar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod(), $fname, $mname, $lname, $tdate, $work, $level, $organ, $sdate, $yun, $address, $tel, $email));
    	return $data[0][0];
    	
    }
    public function editKen_tar($editid, $fname, $mname, $lname, $tdate, $work, $level, $organ, $sdate, $yun, $address, $tel, $email){
    	$data = $this->getAdapter()->fetchAll('CALL editKen_tar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $editid, $fname, $mname, $lname, $tdate, $work, $level, $organ, $sdate, $yun, $address, $tel, $email));
    	return $data[0][0];
    }

    public function del_Kentar($id) {
    	$data = $this->getAdapter()->fetch('DELETE FROM ken_tar WHERE kcode = "'.$this->getSession()->getKenCod().'" AND id = '.$id);
    	return '1';
    }
    public function addKen_iq($fname, $mname, $lname, $work, $level, $organ, $sdate, $yun, $address, $tel, $email){
    	$data = $this->getAdapter()->fetch('CALL addKen_iq(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod(), $fname, $mname, $lname, $work, $level, $organ, $sdate, $yun, $address, $tel, $email));
    	return $data[0];
    	
    }
    public function editKen_iq($editid, $fname, $mname, $lname, $work, $level, $organ, $sdate, $yun, $address, $tel, $email){
    	$data = $this->getAdapter()->fetch('CALL editKen_iq( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(),  $editid, $fname, $mname, $lname, $work, $level, $organ, $sdate, $yun, $address, $tel, $email));
    	return $data[0];
    }

    public function del_Keniq($id) {
    	$data = $this->getAdapter()->fetch('DELETE FROM ken_iq WHERE kcode = "'.$this->getSession()->getKenCod().'" AND id = '.$id);
    	return '1';
    }

    public function addKen_aqt($fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email){
    	$data = $this->getAdapter()->fetch('CALL addKen_aqt(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $this->getSession()->getTCod(), $fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email));
    	return $data[0];
    	
    }
    public function editKen_aqt( $editid, $fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email){
    	$data = $this->getAdapter()->fetch('CALL editKen_aqt(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $editid, $fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email));
    	return $data[0];
    }

    public function del_Kenaqt($id) {
    	$data = $this->getAdapter()->fetch('DELETE FROM ken_aqt WHERE kcode = "'.$this->getSession()->getKenCod().'" AND id = '.$id);
    	return '1';
    }	
    	
    public function addKen_yqt($fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email){
    	$data = $this->getAdapter()->fetch('CALL addKen_yqt(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(),  $this->getSession()->getTCod(), $fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email));
    	return $data[0];
    	
    }
    public function editKen_yqt($editid, $fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email){
    	$data = $this->getAdapter()->fetch('CALL editKen_yqt(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),$this->getSession()->getKenCod(), $editid, $fname, $mname, $lname, $tdate, $education, $nations, $work, $plevel, $address, $tel, $email));
    	return $data[0];
	}
	public function del_Kenyqt($id) {
    	$data = $this->getAdapter()->fetch('DELETE FROM ken_yqt WHERE kcode = "'.$this->getSession()->getKenCod().'" AND id = '.$id);
    	return '1';
    }	
}