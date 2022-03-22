<?php

class Application_Models_Bpt extends Application_Lib_Varien_Object {

	public function getBpt($params = array()) {
    	$params['begin_date'] = date('Y-m-d', strtotime($params['begin_date']));
    	$params['end_date'] = date('Y-m-d', strtotime($params['end_date']));		
		array_unshift($params, $this->getSession()->getSesskey());
    	array_push($params, 1);
    	array_push($params, $this->getSession()->getKenCod());
    	array_push($params, $this->getSession()->getTCod());
        return $this->getAdapter()->fetchAll('CALL getBpt (?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?);', $params);
    }

	public function getDelBPT($params = array()) {
    	$params['begin_date'] = date('Y-m-d', strtotime($params['begin_date']));
    	$params['end_date'] = date('Y-m-d', strtotime($params['end_date']));		
		array_unshift($params, $this->getSession()->getSesskey());
    	array_push($params, 0);
    	array_push($params, $this->getSession()->getKenCod());
    	array_push($params, $this->getSession()->getTCod());
        return $this->getAdapter()->fetchAll('CALL getBpt (?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?);', $params);
    }

	public function getRais($bptid){		
		$data = $this->getAdapter()->fetch('SELECT CONCAT_WS(" ", f_name, m_name, l_name) as fullname, id, plevel FROM azolar WHERE status=1 and bptname="'.$bptid.'" ORDER BY plevel DESC');
		return $data;
	}
	
	public function getnewbpt($id){		

		$data = $this->getAdapter()->fetch('SELECT id, bptname FROM bpt WHERE status = 1 AND  kcode = (select kcode from bpt where id = "'.$id.'" ) and  tcode = (select tcode from bpt where id = "'.$id.'" ) AND NOT   id = "'.$id.'"');

		return $data;

	}

	
	public function delBpt($bptid, $newid, $delre, $ddate){
		$data = $this->getAdapter()->fetch('CALL delBpt (?, ?, ?, ?, ?, ?, ?);',  array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod(), $bptid, $newid, $delre, $ddate));

		return $data[0]; 

	}

	public function setRais($bptid, $newrais) { 
		$data = $this->getAdapter()->fetch('CALL setRais (?, ?, ?, ?, ?);',  array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod(), $bptid, $newrais));
		return $data[0]; 
	}


	public function returnBpt($id, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $level, $worktel) {
    	$data = $this->getAdapter()->fetch('CALL returnBpt(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $id, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work,  $level, $worktel));
    	return $data[0];
    }

	public function addBpt($kname, $bptname, $bptorg, $bptpp, $bptgnum, $bptpa, $bptdate, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel) {
    	$data = $this->getAdapter()->fetch('CALL addBpt (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(), $this->getSession()->getTCod(),$kname, $bptname, $bptorg, $bptpp, $bptgnum, $bptpa, $bptdate, $fname, $mname, $lname, $sex, $nations, $tdate, $passr, $paswho, $pasdate, $education, $profession, $phd, $res, $bpr, $bpi, $adate, $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel));
    	return $data[0];
    }

    public function editBpt($id, $bptname, $bptorg, $bptpp, $bptgnum, $bptpa, $bptdate){
		$data = $this->getAdapter()->fetch('CALL editBpt (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', 
		array($this->getSession()->getSesskey(), $this->getSession()->getKenCod(),$this->getSession()->getTCod(), $id, $bptname, $bptorg, $bptpp, $bptgnum, $bptpa, $bptdate));
		return $data[0];
    }


}