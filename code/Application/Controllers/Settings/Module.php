<?php

class Application_Controllers_Settings_Module extends Application_Controllers_ModelResource {

	public function __construct() {
        $this->indexModel = Application_App::getModel('Index');
        $this->azolarModel = Application_App::getModel('azolar');
        $this->usersFields = array(
					"login" => "Логин",
					"kname" => "Кенгаш номи",
					"status" => "Холати",
					"incorrect" => "Мавофаққиятсиз киришлар сони",
					"enter_datetime" => "Тизимга охирги кирган вақти",
					"enter_ip" => "Тизимга кирган IP",
					"agent" => "Тизимга кирган қурулмаси",
					"update_datetime" => "Маълумотлар таҳрирланган вақт",
					"update_ip" => "Маълумотлар таҳрирланган IP",
					"dl" => "Икки босқичли кириш маълумотлари"	
		);
	}


    public function distAction() {
        $result = $this->indexModel->getChange(
                  $this->getRequest()->getParam('id')
        );
    	return $result;
    }
    public function indexAction() {
    	if($this->getSession()->isLoggedIn()) {

    		
	       $filter = $this->getSession()->getUsersFilter();

	        $defaultFilter = array(

	            "search" => "",

	            "page" => 1,

	            "limit" => 100

	        );

	        $data["filter"] = array(

	            "search" => $this->getRequest()->getParam("search", ""),

	            "page" => $this->getRequest()->getPost("page", 1),

	            "limit" => $this->getRequest()->getPost("limit", 100)

	        );

			if ($this->getRequest()->isPost()) {
				$function = $this->getRequest()->getParam('function');
				if ($function == "genPassword") {
                    $password = substr(hash('sha512',rand()),0,12);
                    exit(json_encode($password));
                }
			if ($function == "changeStatus") {
					$id =  $this->getRequest()->getParam("id");
	        		$result = $this->indexModel->changeStatus($id);
	                if ($result['result'] == 1) {
	                    $response = ['success' => $result['msg_out'], 
	                    			'id' => $id,
	                    			'status' => $result['status']];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
                }
			 	
			 	if($function == "doubleAuth") {
	        		$method = $this->getRequest()->getParam('method', 0);
	        		$email = $this->getRequest()->getParam('email', '');
	        		$telegramId = $this->getRequest()->getParam('telegramid', '');
	        		$result = $this->indexModel->doubleAuth($method, $email, $telegramId);
	                if ($result['result'] == 1) {
	                    $response = ['success' => $result['msg_out']];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
	        	}
	        	if($function == "editpass") {
	        		$oldpass = $this->getRequest()->getParam('oldpass');
	        		$newpass = $this->getRequest()->getParam('newpass');
	        		$result = $this->indexModel->changepass($oldpass, $newpass);
	                if ($result['result'] == 1) {
	                    $response = ['success' => $result['msg_out']];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
	        	}

	        	if($function == "editusers") {	        		
	        		$id = $this->getRequest()->getParam('id');
	        		$newpass = $this->getRequest()->getParam('new_pass');
	        		$result = $this->indexModel->editpass($id, $newpass);
	                if ($result['result'] == 1) {
	                    $response = ['success' => $result['msg_out']];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
	        	}

	        	
			 	if($function == "addmes") {	        		

	        		$ken = $this->getRequest()->getParam('ken');	        		

	        		$type = $this->getRequest()->getParam('type');

	        		$one = $this->getRequest()->getParam('one');	        			        		

	        		$durdate = $this->getRequest()->getParam('durdate', '0000-00-00');

	        		$durtime = $this->getRequest()->getParam('durtime');

	        		$text = $this->getRequest()->getParam('text');
	        		$result = $this->indexModel->addmes($ken, $type, $one, date('Y-m-d', strtotime($durdate)), $durtime, $text);

	                if ($result['result'] == 1) {
	                	$this->getSession()->setSuccess('Хабар сақланди');

	                    $response = ['success' => 'Хабар сақланди'];

	                } else {

	                    $response = ['error' => 'Хатолик юз берди'];

	                }

	                exit(json_encode($response));

	        	}

            	if($function == "delmes") {

            		$id = $this->getRequest()->getParam('id');                  

            		$result = $this->indexModel->delmes($id);

                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess('Хабар муваффақиятли ўчирилди');

                        $response = ['success' => 'Хабар муваффақиятли ўчирилди',

                        			 'id'=> $id];

                    } else {

                        $response = ['error' => 'Хатолик юз берди'];

                    }

                    exit(json_encode($response));            		

            	}	        	

				if($function == "addusers") {	        		
	        		$kname = $this->getRequest()->getParam('kname');	        		
	        		$regions = $this->getRequest()->getParam('regions');
	        		$districts = $this->getRequest()->getParam('districts', '');	        			        		
	        		$login = $this->getRequest()->getParam('login');
	        		$newpass = $this->getRequest()->getParam('newpass');
	        		$status = $this->getRequest()->getParam('status');	        		
	        		$result = $this->indexModel->addusers($kname, $regions, $districts, $login, $newpass, $status);
	                if ($result['result'] == 1) {
	                	$this->getSession()->setSuccess($result['msg_out']);
	                    $response = ['success' => $result['msg_out']];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
	        	}

	        	if($function == "deldis") {
            		$id = $this->getRequest()->getParam('id');                  
            		$result = $this->indexModel->delDis($id);
                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess('Туман муваффақиятли ўчирилди');
                        $response = ['success' => 'Туман муваффақиятли ўчирилди',
                        			 'id'=> $id];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));            		
            	}

            	if($function == "deluser") {
            		$id = $this->getRequest()->getParam('id');                  
            		$result = $this->indexModel->deluser($id);
                    if($result['result'] == 1) {
                    	$this->getSession()->setSuccess('Фойдаланувчи муваффақиятли ўчирилди');
                        $response = ['success' => 'Фойдаланувчи муваффақиятли ўчирилди',
                        			 'id'=> $id];
                    } else {
                        $response = ['error' => $result['msg_out']];
                    }
                    exit(json_encode($response));            		
            	}

            	if($function == "editdis") {	        		
	        		$id = $this->getRequest()->getParam('id');	        		
	        		$name = $this->getRequest()->getParam('dis');
	        		$result = $this->indexModel->editDis($id, $name);
	                if ($result['result'] == 1) {
	                	$this->getSession()->setSuccess('Туман муваффақиятли таҳрирланди');
	                    $response = ['success' => 'Туман муваффақиятли таҳрирланди',
	                    				'id'=> $id];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
	        	}

	        	if($function == "adddis") {	        		
	        		$name = $this->getRequest()->getParam('dis');	        		
	        		$region = $this->getRequest()->getParam('region');
	        		$result = $this->indexModel->addDis($name, $region);
	                if ($result['result'] == 1) {
	                	$this->getSession()->setSuccess($result['msg_out']);
	                    $response = ['success' => $result['msg_out']];
	                } else {
	                    $response = ['error' => $result['msg_out']];
	                }
	                exit(json_encode($response));
	        	}

            	if($function == "setFilter") {
	                $filter[$filter_key] = $data["filter"];
	                $this->getSession()->setUsersFilter($filter);
	            }
	            Application_App::redirect('/settings');

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

			$data['districts'] = $getParAzolar[7];

			$data['district'] = $this->indexModel->getDistricts();

			$result = $this->indexModel->getUsers($data['filter']);

            $data['users'] = $result[0];

	        $data['count_pages'] = $result[1][0]['pagecnt'];

	        $data['count_records'] = $result[1][0]['recordcnt'];

			$data['usersFields'] = $this->usersFields;

			$result = $this->indexModel->getSettings();

			$data['kname']  = $this->getSession()->getKenName();

			$data['role']  = $this->getSession()->getRole();

			$data['settings'] = $result[0][0];

			$data['message'] = $result[1];
			
    		return $data;

		}
    }
}