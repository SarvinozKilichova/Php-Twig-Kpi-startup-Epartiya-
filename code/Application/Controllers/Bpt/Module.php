<?php

class Application_Controllers_bpt_Module extends Application_Controllers_ModelResource {

	public function __construct() {
        $this->azolarModel = Application_App::getModel('azolar');
        $this->bptModel = Application_App::getModel('bpt');
		$this->bptFields = array(
			"bptname" => "Бошланғич партия ташкилоти номи",
			"bpt_kcode" => "Туман (шаҳар) Кенгаши номи",
			"bptjj" => "Бошланғич партия ташкилоти жойлфшган жойи",
			"count_azolar" => "Бошланғич партия ташкилотига бириктирилган аъзолар сони",
			"bptgr_full" => "Бошланғич партия ташкилоти гувоҳнома рақами",
			"bptjman" => "Бошланғич партия ташкилоти жойлашган манзил",
			"bptosana" => "Бошланғич партия ташкилоти ташкил топган сана"
		);
	}

    public function indexAction() {
        if ($this->getSession()->isLoggedIn()) {
        	$filter = $this->getSession()->getbptFilter();
	        $defaultFilter = array(
	        	"kcode" => 0,
	        	"tcode" => 0,
	            "search" => "",
	            "page" => 1,
	            "limit" => 50,
				"begin_date" => '15.02.1995',
	            "end_date" =>  date('d.m.Y')
	        );
	        $data["filter"] = array(
	        	"kcode" => $this->getRequest()->getParam("regions", 0),
	        	"tcode" => $this->getRequest()->getParam("dis", 0),
	            "search" => $this->getRequest()->getParam("search", ""),
	            "page" => $this->getRequest()->getPost("page", 1),
	            "limit" => $this->getRequest()->getPost("limit", 50),
	            "begin_date" => $this->getRequest()->getParam('begin_date', '15.02.1995'),
       			"end_date" => $this->getRequest()->getParam('end_date', date('d.m.Y'))	            
	        );
            if ($this->getRequest()->isPost()) {
            	$this->getSession()->unsetMessages();
            	$function = $this->getRequest()->getParam('function');
            	if($function == "addbpt") {
            		$kname = $this->getRequest()->getParam('kname');
            		if ($this->getSession()->getRole() == 3) {
            			$kname = $this->getSession()->getTCod();
            		}            		
            		$bptorg = $this->getRequest()->getParam('bptorg');
            		$bptpp = $this->getRequest()->getParam('bptpp');
            		$bptgnum = $this->getRequest()->getParam('bptgnum');
            		$bptpa = $this->getRequest()->getParam('bptpa');
            		$bptdate = $this->getRequest()->getParam('bptdate');
            		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$sex = $this->getRequest()->getParam('sex');
            		$nations = $this->getRequest()->getParam('nations');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$passr = $this->getRequest()->getParam('passr');
            		$paswho = $this->getRequest()->getParam('paswho');
            		$pasdate = $this->getRequest()->getParam('pasdate');
            		$education = $this->getRequest()->getParam('education');
            		$profession = $this->getRequest()->getParam('profession');
            		$phd = $this->getRequest()->getParam('phd', '');
            		$res = $this->getRequest()->getParam('res');
            		$bpr = $this->getRequest()->getParam('bpr', '');
            		$bpi = $this->getRequest()->getParam('bpi', '');
            		$bptname = $this->getRequest()->getParam('bptname');
            		$adate = $this->getRequest()->getParam('adate');
            		$pnum = $this->getRequest()->getParam('pnum', '');
            		$dep = $this->getRequest()->getParam('dep', '');
            		$sdate = $this->getRequest()->getParam('sdate', 'NULL');
            		$lpr = $this->getRequest()->getParam('lpr');
            		$lpd = $this->getRequest()->getParam('lpd');
            		$lpmfy = $this->getRequest()->getParam('lpmfy', '');
            		$lpi = $this->getRequest()->getParam('lpi', '');
            		$tel = $this->getRequest()->getParam('tel', '');
            		$email = $this->getRequest()->getParam('email', '');
            		$activity = $this->getRequest()->getParam('activity');
            		$work = $this->getRequest()->getParam('work', '');
            		$ll = $this->getRequest()->getParam('ll', '');
            		$level = $this->getRequest()->getParam('level', '');
            		$worktel = $this->getRequest()->getParam('worktel', ''); 
            		if ($level == '') {
            			$level = $this->getRequest()->getParam('edulevel', ''); 
            		}
            		$result = $this->bptModel->addBpt($kname, $bptname, $bptorg, $bptpp, $bptgnum, $bptpa, date('Y-m-d', strtotime($bptdate)), $fname, $mname, $lname, $sex, $nations, 
            		date('Y-m-d', strtotime($tdate)), $passr, $paswho, date('Y-m-d', strtotime($pasdate)), $education, $profession, $phd, $res, $bpr, $bpi, date('Y-m-d', strtotime($adate)), $pnum, $dep, 
            	$sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel);
                   	if($result['result'] == 1) {
                   		$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
            	}



            	if($function == "editbpt") {
            		$id = $this->getRequest()->getParam('id');
            		$bptname = $this->getRequest()->getParam('bpt');
            		$bptorg = $this->getRequest()->getParam('bptorg');
            		$bptpp = $this->getRequest()->getParam('bptpp');
            		$bptgnum = $this->getRequest()->getParam('bptgnum');
            		$bptpa = $this->getRequest()->getParam('bptpa');
            		$bptdate = $this->getRequest()->getParam('bptdate');
            		$result = $this->bptModel->editBpt($id, $bptname, $bptorg, $bptpp, $bptgnum, $bptpa, date('Y-m-d', strtotime($bptdate))); 
                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));

            	}

            	if ($function == "bptchange") {
            		
            		$bptid = $this->getRequest()->getParam('bptid');
            		$newrais = $this->getRequest()->getParam('newrais');
            		$result  = $this->bptModel->setRais($bptid, $newrais);
                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }            		
            		exit(json_encode($response));
            	}
            	
            	if ($function == "delbpt") {            		

            		$bptid = $this->getRequest()->getParam('id');

            		$newid = $this->getRequest()->getParam('newbpt');

            		$delre = $this->getRequest()->getParam('delre');

            		$ddate = $this->getRequest()->getParam('ddate');

            		$result  = $this->bptModel->delBpt($bptid, $newid, $delre, date('Y-m-d', strtotime($ddate)));

                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);

                        $response = ['success' => $result['msg_out']];

                    } else {

                        $response = ['error' => $result['msg_out']];

                    }            		

            		exit(json_encode($response));

            	}


	            if($function == "setFilter") {
	                $filter[$filter_key] = $data["filter"];
	                $this->getSession()->setbptFilter($filter);
	            }
	            Application_App::redirect('/bpt');

			}
            
			if(!empty($filter[$filter_key])) {
	            $data["filter"] = $filter[$filter_key];
	        }
	        if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }

        	$getParAzolar= $this->azolarModel->getParAzolar();
            $data['nations'] = $getParAzolar[0];
            $data['educations'] = $getParAzolar[1];
            $data['professions'] = $getParAzolar[2];
            $data['phd'] = $getParAzolar[3];
            $data['respublics'] = $getParAzolar[4];
            $data['regions'] = $getParAzolar[5];
            $data['bpt_name'] = $getParAzolar[6];
            $data['districts'] = $getParAzolar[7];
            $data['activity'] = $getParAzolar[8];
            $data['dis'] =  $getParAzolar[9];
            $data['bpt_organizations'] =  $getParAzolar[10];

            $result = $this->bptModel->getBpt($data['filter']);
            $data['bpt'] = $result[0];
	        $data['count_pages'] = $result[1][0]['pagecnt'];
	        $data['count_records'] = $result[1][0]['recordcnt'];
        	$data['kname']  = $this->getSession()->getKenName(); 
        	$data['kcode']  = $this->getSession()->getKenCod(); 
        	$data['tcode']  = $this->getSession()->getTCod();
        	$data['role']  = $this->getSession()->getRole();
            return $data;
        }
    }

    public function getazolarAction() {
    	if ($this->getSession()->isLoggedIn()) {
	    	$result = $this->bptModel->getRais(
	    			$this->getRequest()->getParam('bptid')
	    	);
	    	return $result;
    	}
    }
    
    public function getbptAction() {

    	if ($this->getSession()->isLoggedIn()) {

	    	$result = $this->bptModel->getNewbpt(

	    			$this->getRequest()->getParam('id')

	    	);

	    	return $result;

    	}

    }

    public function delAction(){    	
    	if ($this->getSession()->isLoggedIn()) {
        	$filter = $this->getSession()->getDelbptFilter();
	        $defaultFilter = array(
	        	"kcode" => 0,
	        	"tcode" => 0,
	            "search" => "",
	            "page" => 1,
	            "limit" => 50,
				"begin_date" => '15.02.1995',
	            "end_date" =>  date('d.m.Y')	            
	        );
	        $data["filter"] = array(
	        	"kcode" => $this->getRequest()->getParam("regions", 0),
	        	"tcode" => $this->getRequest()->getParam("dis", 0),
	            "search" => $this->getRequest()->getParam("search", ""),
	            "page" => $this->getRequest()->getPost("page", 1),
	            "limit" => $this->getRequest()->getPost("limit", 50),
	            "begin_date" => $this->getRequest()->getParam('begin_date', '15.02.1995'),
       			"end_date" => $this->getRequest()->getParam('end_date', date('d.m.Y'))
	        );
    		if ($this->getRequest()->isPost()) {
    			$this->getSession()->unsetMessages();
            	$function = $this->getRequest()->getParam('function');

            if($function == "returnbpt") {
            		$id =  $this->getRequest()->getParam('id');
            		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$sex = $this->getRequest()->getParam('sex');
            		$nations = $this->getRequest()->getParam('nations');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$passr = $this->getRequest()->getParam('passr');
            		$paswho = $this->getRequest()->getParam('paswho');
            		$pasdate = $this->getRequest()->getParam('pasdate');
            		$education = $this->getRequest()->getParam('education');
            		$profession = $this->getRequest()->getParam('profession');
            		$phd = $this->getRequest()->getParam('phd', '');
            		$res = $this->getRequest()->getParam('res');
            		$bpr = $this->getRequest()->getParam('bpr', '');
            		$bpi = $this->getRequest()->getParam('bpi', '');
            		$adate = $this->getRequest()->getParam('adate');
            		$pnum = $this->getRequest()->getParam('pnum', '');
            		$dep = $this->getRequest()->getParam('dep', '');
            		$sdate = $this->getRequest()->getParam('sdate', 'NULL');
            		$lpr = $this->getRequest()->getParam('lpr');
            		$lpd = $this->getRequest()->getParam('lpd');
            		$lpmfy = $this->getRequest()->getParam('lpmfy', '');
            		$lpi = $this->getRequest()->getParam('lpi', '');
            		$tel = $this->getRequest()->getParam('tel', '');
            		$email = $this->getRequest()->getParam('email', '');
            		$activity = $this->getRequest()->getParam('activity');
            		$work = $this->getRequest()->getParam('work', '');
            		$ll = $this->getRequest()->getParam('ll', '');
            		$level = $this->getRequest()->getParam('level', '');
            		$worktel = $this->getRequest()->getParam('worktel', ''); 
            		if ($level == '') {
            			$level = $this->getRequest()->getParam('edulevel', ''); 
            		}
            		$result = $this->bptModel->returnBpt($id, $fname, $mname, $lname, $sex, $nations, 
            		date('Y-m-d', strtotime($tdate)), $passr, $paswho, date('Y-m-d', strtotime($pasdate)), $education, $profession, $phd, $res, $bpr, $bpi, date('Y-m-d', strtotime($adate)), $pnum, $dep, 
            	 $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel);
                   	if($result['result'] == 1) {
                   		$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
            	}

	            if($function == "setFilter") {
	                $filter[$filter_key] = $data["filter"];
	                $this->getSession()->setDelbptFilter($filter);
	            }
	            Application_App::redirect('/bpt/del');
            }
			if(!empty($filter[$filter_key])) {
	            $data["filter"] = $filter[$filter_key];
	        } 
	                   
	        if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }

    		$getParAzolar= $this->azolarModel->getParAzolar();
    		$data['nations'] = $getParAzolar[0];
            $data['educations'] = $getParAzolar[1];
            $data['professions'] = $getParAzolar[2];
            $data['phd'] = $getParAzolar[3];
            $data['respublics'] = $getParAzolar[4];
            $data['regions'] = $getParAzolar[5];
            $data['bpt_name'] = $getParAzolar[6];
            $data['districts'] = $getParAzolar[7];
            $data['activity'] = $getParAzolar[8];
            $data['dis'] =  $getParAzolar[9];
    	    $result = $this->bptModel->getDelBPT($data['filter']);
            $data['bpt'] = $result[0];
	        $data['count_pages'] = $result[1][0]['pagecnt'];
	        $data['count_records'] = $result[1][0]['recordcnt'];
        	$data['kname']  = $this->getSession()->getKenName(); 
        	$data['kcode']  = $this->getSession()->getKenCod(); 
        	$data['role']  = $this->getSession()->getRole();    		
    		return $data;
    	}
    }
}