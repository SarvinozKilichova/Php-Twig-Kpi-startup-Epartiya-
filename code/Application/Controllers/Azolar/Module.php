<?

class Application_Controllers_Azolar_Module extends Application_Controllers_ModelResource {

	public function __construct() {
        $this->azolarModel = Application_App::getModel('azolar');
        $this->indexModel = Application_App::getModel('index');  
		$this->azolarFields = array(
			"fullname" => "Ф.И.О",
			"jins" => "Жинси",
			"ination" => "Миллати",
			"tsana" => "Туғуллан санаси",
			"pas_sr" => "Паспорт серия ва рақами",
			"pas_who" => "Паспорт кийб томонидан берилган",
			"pas_date" => "Паспорт берилган вақти",
			"ieducation" => "Маълумоти",
			"iprofession" => "Мутахассислиги",
			"iphd" => "Илмий даражаси",
			"ires" => "Республика",
			"ibpr" => "Вилоят",
			"tbpi" => "Туғулган манзили",
			"itkname" => "Кенгаш номи",
			"ibptname" => "Қайси БПТ ҳисобида туради",
			"asana" => "Аъзо бўлган санаси",
			"pnum" => "Партия билет рақами",
			"iplevel" => "Партиявий лавозими",
			"idep" => "Депутатлиги",
            "sdate" => "Сайланган санаси",
            "yajv" => "Вилоят",
            "yajt" => "Туман",
            "yajmfy" => "МФЙ/ҚФЙ/ШФЙ",
            "yajqi" => "Яшаш манзили",
            "tel" => "Телефон рақами",
            "email" => "Электрон почтаси",
            "iactivity" => "Фаолият соҳаси",
            "ishj" => "Иш жойи",
            "ishlavozm" => "Лавозими",
            "level"  => "Иш лавозими",
            "ishtel" => "Иш телефон рақами"
		);
	}

    public function indexAction() {
        if ($this->getSession()->isLoggedIn()) {
           
	        $filter = $this->getSession()->getAzolarFilter();
	        $defaultFilter = array(
	        	"kcode" => 0,
	        	"tcode" => 0,
	            "search" => "",
	            "page" => 1,
	            "limit" => 100,
	            "begin_date" => '15.02.1995',
	            "end_date" =>  date('d.m.Y')
	        );

	        $data["filter"] = array(
	        	"kcode" => $this->getRequest()->getParam("regions", 0),
	        	"tcode" => $this->getRequest()->getParam("dis", 0),
	            "search" => $this->getRequest()->getParam("search", ""),
	            "page" => $this->getRequest()->getPost("page", 1),
	            "limit" => $this->getRequest()->getPost("limit", 100),
	            "begin_date" => $this->getRequest()->getParam('begin_date', '15.02.1995'),
       			"end_date" => $this->getRequest()->getParam('end_date', date('d.m.Y'))

	        );
            if ($this->getRequest()->isPost()) {
            	$this->getSession()->unsetMessages();
            	$function = $this->getRequest()->getParam('function');

            	if($function == "addazo") {
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
            		$bptname = $this->getRequest()->getParam('bpt_name');
            		$kname = $this->getRequest()->getParam('kname');
            		if ($this->getSession()->getRole() == 3) {
            			$kname = $this->getSession()->getTCod();
            		}
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
            		$level = $this->getRequest()->getParam('level', $this->getRequest()->getParam('edulevel', ''));
            		$worktel = $this->getRequest()->getParam('worktel', ''); 
            		$result = $this->azolarModel->addAzo($kname, $fname, $mname, $lname, $sex, $nations, date('Y-m-d', strtotime($tdate)), $passr, $paswho, date('Y-m-d', strtotime($pasdate)), $education, $profession, $phd, $res, $bpr, $bpi, $bptname, date('Y-m-d', strtotime($adate)), $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
            	}

            	if($function == "editazo") {
            		$editid = $this->getRequest()->getParam('editid');
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
            		$bptname = $this->getRequest()->getParam('bpt_name');
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
            		$result = $this->azolarModel->editAzo($editid, $fname, $mname, $lname, $sex, $nations, date('Y-m-d', strtotime($tdate)), $passr, $paswho, date('Y-m-d', strtotime($pasdate)), $education, $profession, $phd, $res, $bpr, $bpi, $bptname, date('Y-m-d', strtotime($adate)), $pnum, $dep, $sdate, $lpr, $lpd, $lpmfy, $lpi, $tel, $email, $activity,  $work, $ll, $level, $worktel);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out'],
                        			 'id'=> $editid];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
            	}

            	if($function == "delazo") {
            		$id = $this->getRequest()->getParam('id');
                    $aus = $this->getRequest()->getParam('aus');
                    $audate = $this->getRequest()->getParam('audate');
            		$result = $this->azolarModel->delAzo($id, $aus, date('Y-m-d', strtotime($audate)));
                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out'],
                        			 'id'=> $id];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));            		
            	}

            	if($function == "changeazo") {
            		$id = $this->getRequest()->getParam('id');
                    $bptname = $this->getRequest()->getParam('bptname');
                    $tcode = $this->getRequest()->getParam('kname');
            		$result = $this->azolarModel->changeAzo($id, $bptname, $tcode);
                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out'],
                        			 'id'=> $id];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));            		
            	}

	            if($function == "setFilter") {
	                $filter[$filter_key] = $data["filter"];
	                $this->getSession()->setAzolarFilter($filter);
	            	Application_App::redirect('/azolar');
	            }

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
            $result = $this->azolarModel->getAzolar($data['filter']);
            $data['azolar'] = $result[0];
	        $data['count_pages'] = $result[1][0]['pagecnt'];
	        $data['count_records'] = $result[1][0]['recordcnt'];            
            $data['azolarFields'] = $this->azolarFields;
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }
    }

   public function getbptAction() {
    	if ($this->getSession()->isLoggedIn()) {
	    	$result = $this->azolarModel->getBpt(
	    			$this->getRequest()->getParam('id')
	    	);
	    	return $result;
    	}
    }
    
    public function delAction(){
    	if ($this->getSession()->isLoggedIn()) {

	        $filter = $this->getSession()->getDelAzolarFilter();
	        $defaultFilter = array(
	        	"kcode" => 0,
	        	"tcode" => 0,
	            "search" => "",
	            "page" => 1,
	            "limit" => 100,
	            "begin_date" => '15.02.1995',
	            "end_date" =>  date('d.m.Y')
	        );
	        $data["filter"] = array(
	        	"kcode" => $this->getRequest()->getParam("regions", 0),
	        	"tcode" => $this->getRequest()->getParam("dis", 0),
	            "search" => $this->getRequest()->getParam("search", ""),
	            "page" => $this->getRequest()->getPost("page", 1),
	            "limit" => $this->getRequest()->getPost("limit", 100),
	            "begin_date" => $this->getRequest()->getParam('begin_date', '15.02.1995'),
       			"end_date" => $this->getRequest()->getParam('end_date', date('d.m.Y'))
	        );

    	 	if ($this->getRequest()->isPost()) {
            	$function = $this->getRequest()->getParam('function');
    			
    			if($function == "returnazo") {
            		$id = $this->getRequest()->getParam('id');
            		$result = $this->azolarModel->returnAzo($id);
                      if($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' =>$result['msg_out'],
                        			 'id'=> $id];
                    } else {
                        $response = ['error' =>$result['msg_out']];
                    }
                    exit(json_encode($response));           		
            	}
            	
            	if($function == "setFilter") {
	                $filter[$filter_key] = $data["filter"];
	                $this->getSession()->setDelAzolarFilter($filter);
	            }
	            Application_App::redirect('/azolar/del');
            }

			if(!empty($filter[$filter_key])) {
		        $data["filter"] = $filter[$filter_key];
		    }

		    if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }
    		$getParAzolar= $this->azolarModel->getParAzolar();
    		$data['regions'] = $getParAzolar[5];
            $data['dis'] =  $getParAzolar[9];
            $result = $this->azolarModel->getDelAzolar($data['filter']);
            $data['azolar'] = $result[0];
	        $data['count_pages'] = $result[1][0]['pagecnt'];
	        $data['count_records'] = $result[1][0]['recordcnt'];   		
    		$data['kname']  = $this->getSession()->getKenName();
    		$data['role']  = $this->getSession()->getRole();
    		return $data;
    	}
    }

}