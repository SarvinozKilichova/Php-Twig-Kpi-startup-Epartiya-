<?php

class Application_Models_Azolar extends Application_Lib_Varien_Object {

	public function getParAzolar(){
	    return $this->getAdapter()->fetchAll('CALL  getParAzolar(?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod()));
    }

    public function getDelAzolar($params = array()) {
    	$params['begin_date'] = date('Y-m-d', strtotime('15.02.1995'));
    	$params['end_date'] = date('Y-m-d');
    	array_unshift($params, $this->getSession()->getSesskey());
    	array_push($params, 0);
    	array_push($params, $this->getSession()->getKenCod());
    	array_push($params, $this->getSession()->getTCod());
        $data = $this->getAdapter()->fetchAll('CALL getAzolar (?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?);', $params);
        return $data;
    }   

    public function getAzolar($params = array() ) {
    	$params['begin_date'] = date('Y-m-d', strtotime($params['begin_date']));
    	$params['end_date'] = date('Y-m-d', strtotime($params['end_date']));
    	array_unshift($params, $this->getSession()->getSesskey());
    	array_push($params, 1);
    	array_push($params, $this->getSession()->getKenCod());
    	array_push($params, $this->getSession()->getTCod());
        $data = $this->getAdapter()->fetchAll('CALL getAzolar (?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?);', $params);
        return $data;
    }

    public function delAzo($id, $aus, $audate) {
    	$data = $this->getAdapter()->fetch('CALL delAzo(?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod(),$id, $aus, $audate));
    	return $data[0];
    }

    public function returnAzo($id) {
    	$data = $this->getAdapter()->fetch('CALL returnAzo(?, ?);', array($this->getSession()->getSesskey(), $id));
    	return $data[0];
    }
    public function changeAzo($id, $bptname, $tcode) {
    	$data = $this->getAdapter()->fetch('CALL changeAzo(?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $id, $bptname, $tcode));
    	return $data[0];
    }

    public function editAzo($editid, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $bptname, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel){
    	$data = $this->getAdapter()->fetch('CALL editAzo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getTCod(), $this->getSession()->getKenCod(), $editid, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $bptname, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity, $work, $ll, $level, $worktel));
    	return $data[0];
    }

    public function addAzo($kname, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $bptname, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel){
    	$data = $this->getAdapter()->fetch('CALL addAzo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(),  $this->getSession()->getKenCod(), $this->getSession()->getTCod(), $kname, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $bptname, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel));
    	return $data[0];
    }

    public function getBpt($id){		
		$data = $this->getAdapter()->fetch('SELECT bptname, idinsert  FROM bpt WHERE  status=1 and  kcode = (SELECT kcode from azolar where id = "'.$id.'") and tcode =  (SELECT tcode from azolar where id = "'.$id.'")');
		return $data;
	}
}