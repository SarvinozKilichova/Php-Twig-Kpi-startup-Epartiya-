<?php
    
class Application_Controllers_Ilova_Module extends Application_Controllers_ModelResource {
	
    public function __construct() {
        $this->azolarModel = Application_App::getModel('Azolar');
        $this->indexModel = Application_App::getModel('Ilova');
	}

    public function indexAction() {
        if ($this->getSession()->isLoggedIn()) {
            header("Location: /ilova/i1");
            exit();
        }
    }

    public function i1Action() {
         if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(1, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i1'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }

    public function i2Action() {
		$begin_date = $this->getRequest()->getParam('begin_date', '15.02.1995');
		$end_date = $this->getRequest()->getParam('end_date', date('d.m.Y'));
        if ($this->getSession()->isLoggedIn()) {
            
	        $filter = $this->getSession()->geti2Filter();
	        $defaultFilter = array(
	            "page" => 1,
	            "limit" => 50
	        );
	        $data["filter"] = array(
	            "page" => $this->getRequest()->getPost("page", 1),
	            "limit" => $this->getRequest()->getPost("limit", 50)
	        );            
            if ($this->getRequest()->isPost()) {
            	$this->getSession()->unsetMessages();
            	$function = $this->getRequest()->getParam('function');
	            if($function == "setFilter") {
	                $filter[$filter_key] = $data["filter"];
	                $this->getSession()->seti2Filter($filter);
	            }
	            Application_App::redirect('/ilova/i2');

			}       
	        if(!empty($filter[$filter_key])) {
	            $data["filter"] = $filter[$filter_key];
	        }
			
        	$data['count'] = $this->indexModel->getAllCount();
            $result = $this->indexModel->getIlova(2, date('Y-m-d', strtotime($begin_date)) , date('Y-m-d', strtotime($end_date)), $data['filter']['page'], $data['filter']['limit']);
            $data['i2'] = $result[0];
            $data['begin_date']= $begin_date;
            $data['end_date']= $end_date;
            $data['total'] = $this->total_sum($data['i2']);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();	        
            $data['count_pages'] = $result[1][0]['pagecnt'];
	        $data['count_records'] = $result[1][0]['recordcnt'];  
            return $data;
        }        
    }

    public function i3Action() {
		if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(3, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i3'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }



    public function i4Action() {
		if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(4, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i4'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }


    public function i5Action() {
         if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(5, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i5'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }


    public function i6Action() {
         if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(6, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i6'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }


    public function i7Action() {
         if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(7, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i7'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }

    public function i8Action() {
         if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(8, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i8'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }


    public function i9Action() {
		$begin_date = $this->getRequest()->getParam('begin_date', '15.02.1995');
		$end_date = $this->getRequest()->getParam('end_date', date('d.m.Y'));
        if ($this->getSession()->isLoggedIn()) {
        	$data['count'] = $this->indexModel->getAllCount();
            $result = $this->indexModel->getIlova(9, date('Y-m-d', strtotime($begin_date)) , date('Y-m-d', strtotime($end_date)));
            $data['i9'] = $result[0];
            $data['begin_date']= $begin_date;
            $data['end_date']= $end_date;
            $data['total'] = $this->total_sum($data['i9']);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();

			$_monthsList = array(
				".01." => "январ",
				".02." => "феврал",
				".03." => "март",
				".04." => "апрел",
				".05." => "май",
				".06." => "июнь",
				".07." => "июль",
				".08." => "август",
				".09." => "сентябрь",
				".10." => "октябрь",
				".11." => "ноябрь",
				".12." => "декабрь"
			);

			$begin_month = date(".m.", strtotime($begin_date));
            $data['column1'] = str_replace($begin_month, $_monthsList[$begin_month], date('Y йил d-.m.', strtotime($begin_date))).' ҳолатига аъзолар сони'; 
            $data['column2'] = date('Y', strtotime($begin_date)).'-'.date('Y', strtotime($end_date)).' йил давомида партия аъзолигига қабул қилинганлар';
            $data['column3'] = date('Y', strtotime($begin_date)).'-'.date('Y', strtotime($end_date)).' йил давомида партия аъзолигидан чиққанлар';
            $end_month = date(".m.", strtotime($end_date));
            $data['column4'] = str_replace($end_month, $_monthsList[$end_month], date('Y йил d-.m.', strtotime($end_date))).' ҳолатига аъзолар сони';
            return $data;
        }        
    }

    public function i10Action() {


		 if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(10, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i10'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            $data['bpt_sana'] = date('Y', strtotime('-1 year'));
            return $data;
        }   
    }   	
	
    public function i11Action() {

    	if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(11, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i11'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
			$time = strtotime($data['end_date'].'-1 years');
    		$rs_date = date("Y", $time);
            $data['column1'] = $rs_date.'-йилда қайта сайланганлар сони';
            return $data;
        }   
    }

    public function i12Action() {
        if ($this->getSession()->isLoggedIn()) {
        	 if ($this->getRequest()->isPost()) {
        	 	$function = $this->getRequest()->getParam('function');

        	 	if($function == "addkentar") {
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$work = $this->getRequest()->getParam('work');
            		$level = $this->getRequest()->getParam('level');
            		$organ = $this->getRequest()->getParam('organ');
            		$sdate = $this->getRequest()->getParam('sdate');
            		$yun = $this->getRequest()->getParam('yun');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->addKen_tar($fname, $mname, $lname, date('Y-m-d', strtotime($tdate)), $work, $level, $organ, date('Y-m-d', strtotime($sdate)), $yun, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }

                if($function == "editkentar") {
                	$editid = $this->getRequest()->getParam('editid');
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$work = $this->getRequest()->getParam('work');
            		$level = $this->getRequest()->getParam('level');
            		$organ = $this->getRequest()->getParam('organ');
            		$sdate = $this->getRequest()->getParam('sdate');
            		$yun = $this->getRequest()->getParam('yun');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->editKen_tar($editid, $fname, $mname, $lname, date('Y-m-d', strtotime($tdate)), $work, $level, $organ, date('Y-m-d', strtotime($sdate)), $yun, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }

                if ($function == 'delkentar') {
            		$id = $this->getRequest()->getParam('id');                   
            		$result = $this->indexModel->del_Kentar($id);
            		if($result == 1) {
            			$this->getSession()->setSuccess('Аъзоликдан мувоффақиятли ўчирилди');
                		$response = ['success' => 'Аъзоликдан мувоффақиятли ўчирилди.',
                			 'id'=> $id];
            				} else {
                		$response = ['error' => 'Хатолик юз берди.'];
            		}
            		exit(json_encode($response));
                }


        	 }
        	  if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }
            $data['kname']  = $this->getSession()->getKenName();
            $data['ken_tar'] = $this->indexModel->getKen_tar();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }        
    } 

    public function i13Action() {
        if ($this->getSession()->isLoggedIn()) {
        	 if ($this->getRequest()->isPost()) {
        	 	$function = $this->getRequest()->getParam('function');

        	 	if($function == "addkeniq") {
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$work = $this->getRequest()->getParam('work');
            		$level = $this->getRequest()->getParam('level');
            		$organ = $this->getRequest()->getParam('organ');
            		$sdate = $this->getRequest()->getParam('sdate');
            		$yun = $this->getRequest()->getParam('yun');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->addKen_iq($fname, $mname, $lname, $work, $level, $organ, date('Y-m-d', strtotime($sdate)), $yun, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }

                if($function == "editkeniq") {
                	$editid = $this->getRequest()->getParam('editid');
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$work = $this->getRequest()->getParam('work');
            		$level = $this->getRequest()->getParam('level');
            		$organ = $this->getRequest()->getParam('organ');
            		$sdate = $this->getRequest()->getParam('sdate');
            		$yun = $this->getRequest()->getParam('yun');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->editKen_iq($editid, $fname, $mname, $lname, $work, $level, $organ, date('Y-m-d', strtotime($sdate)), $yun, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }

                if ($function == 'delkeniq') {
            		$id = $this->getRequest()->getParam('id');                   
            		$result = $this->indexModel->del_Keniq($id);
            		if($result == 1) {
            			$this->getSession()->setSuccess('Аъзоликдан мувоффақиятли ўчирилди');
                		$response = ['success' => 'Аъзоликдан мувоффақиятли ўчирилди.',
                			 'id'=> $id];
            				} else {
                		$response = ['error' => 'Хатолик юз берди.'];
            		}
		            exit(json_encode($response));
                }
        	 }

        	if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }
        	$getParAzolar= $this->azolarModel->getParAzolar();
        	$data['count'] = $this->indexModel->getAllCount();
            $data['dis'] =  $getParAzolar[9];
            $data['ken_iq'] = $this->indexModel->getKen_iq();
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }        
    } 

    public function i14Action() {
        if ($this->getSession()->isLoggedIn()) {
        	 if ($this->getRequest()->isPost()) {
        	 	$function = $this->getRequest()->getParam('function');
        	 	if($function == "addkenaqt") {
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$education = $this->getRequest()->getParam('education');
            		$nations = $this->getRequest()->getParam('nations');
            		$work = $this->getRequest()->getParam('work');
            		$plevel = $this->getRequest()->getParam('plevel');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->addKen_aqt($fname, $mname, $lname, date('Y-m-d', strtotime($tdate)), $education, $nations, $work, $plevel, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }
                if($function == "editkenaqt") {
                	$editid = $this->getRequest()->getParam('editid');
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$education = $this->getRequest()->getParam('education');
            		$nations = $this->getRequest()->getParam('nations');
            		$work = $this->getRequest()->getParam('work');
            		$plevel = $this->getRequest()->getParam('plevel');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->editKen_aqt($editid, $fname, $mname, $lname, date('Y-m-d', strtotime($tdate)), $education, $nations, $work, $plevel, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }

                if ($function == 'delkenaqt') {
            		$id = $this->getRequest()->getParam('id');                
            		$result = $this->indexModel->del_Kenaqt($id);
            		if($result == 1) {
            			$this->getSession()->setSuccess('Аъзоликдан мувоффақиятли ўчирилди');
                		$response = ['success' => 'Аъзоликдан мувоффақиятли ўчирилди.',
                			 'id'=> $id];
            				} else {
                		$response = ['error' => 'Хатолик юз берди.'];
            		}
		            exit(json_encode($response));
                }
        	 }
        	if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }

        	$getParAzolar= $this->azolarModel->getParAzolar();
        	$data['nations'] = $getParAzolar[0];
            $data['educations'] = $getParAzolar[1];
            $data['dis'] =  $getParAzolar[9];
            $data['count'] = $this->indexModel->getAllCount();
            $data['ken_aqt'] = $this->indexModel->getKen_aqt();
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }        
    } 

    public function i15Action() {
        if ($this->getSession()->isLoggedIn()) {
        	if ($this->getRequest()->isPost()) {
        	 	$function = $this->getRequest()->getParam('function');
        	 	if($function == "addkenyqt") {
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$education = $this->getRequest()->getParam('education');
            		$nations = $this->getRequest()->getParam('nations');
            		$work = $this->getRequest()->getParam('work');
            		$plevel = $this->getRequest()->getParam('plevel');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->addKen_yqt($fname, $mname, $lname, date('Y-m-d', strtotime($tdate)), $education, $nations, $work, $plevel, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }
                if($function == "editkenyqt") {
                	$editid = $this->getRequest()->getParam('editid');
        	 		$fname = $this->getRequest()->getParam('fname');
            		$mname = $this->getRequest()->getParam('mname');
            		$lname = $this->getRequest()->getParam('lname', '');
            		$tdate = $this->getRequest()->getParam('tdate');
            		$education = $this->getRequest()->getParam('education');
            		$nations = $this->getRequest()->getParam('nations');
            		$work = $this->getRequest()->getParam('work');
            		$plevel = $this->getRequest()->getParam('plevel');
            		$address = $this->getRequest()->getParam('address');						            		
            		$tel = $this->getRequest()->getParam('tel');
            		$email = $this->getRequest()->getParam('email', '');
            		
            		$result = $this->indexModel->editKen_yqt($editid, $fname, $mname, $lname, date('Y-m-d', strtotime($tdate)), $education, $nations, $work, $plevel, $address, $tel, $email);
                    if ($result['result'] == 1) {
                    	$this->getSession()->setSuccess($result['msg_out']);
                        $response = ['success' => $result['msg_out']];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));
                }
                if ($function == 'delkenyqt') {
            		$id = $this->getRequest()->getParam('id');                   
            		$result = $this->indexModel->del_Kenyqt($id);
            		if($result == 1) {
            			$this->getSession()->setSuccess('Аъзоликдан мувоффақиятли ўчирилди');
                		$response = ['success' => 'Аъзоликдан мувоффақиятли ўчирилди.',
                			 'id'=> $id];
            				} else {
                		$response = ['error' => 'Хатолик юз берди.'];
            		}
		            exit(json_encode($response));
                }
        	 }

 			if ($this->getSession()->getSuccess() <> '' ) {
                $data['success'] = $this->getSession()->getSuccess();
                $this->getSession()->unsSuccess();
            }
        	$getParAzolar= $this->azolarModel->getParAzolar();
        	$data['nations'] = $getParAzolar[0];
            $data['educations'] = $getParAzolar[1];
            $data['dis'] =  $getParAzolar[9];
            $data['count'] = $this->indexModel->getAllCount();
            $data['ken_yqt'] = $this->indexModel->getKen_yqt();
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }        
    } 

    public function i18Action() {
         if ($this->getSession()->isLoggedIn()) {
       		$data['begin_date'] = $this->getRequest()->getParam('begin_date', '15.02.1995');
       		$data['end_date'] = $this->getRequest()->getParam('end_date', date('d.m.Y'));

            $data['count'] = $this->indexModel->getAllcount();
            $result = $this->indexModel->getIlova(18, date('Y-m-d', strtotime($data['begin_date'])) , date('Y-m-d', strtotime($data['end_date'])));
            $data['i18'] = $result[0];
            $data['total'] = $this->total_sum($result[0]);
            $data['kname']  = $this->getSession()->getKenName();
            $data['role']  = $this->getSession()->getRole();
            return $data;
        }   
    }


}