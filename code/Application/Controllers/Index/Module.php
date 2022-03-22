<?php

class Application_Controllers_Index_Module extends Application_Controllers_ModelResource {
    
    public function __construct() {
        $this->indexModel = Application_App::getModel('Index');
	}

    public function indexAction() {
        if($this->getSession()->isLoggedIn()) {
			//$data['kengash'] = $this->indexModel->getKengash();
			$data['kname']  = $this->getSession()->getKenName();
			$result = $this->indexModel->getAllCount();
			$data['count'] = $result[0][0]; 
			$data['newcount'] = $result[1][0];
			$data['message'] = $result[2];
			$data['role']  = $this->getSession()->getRole();			
			//print_r($data);
            return $data;
        }
        
    }

    public function distAction() {
        $result = $this->indexModel->getDist(
                  $this->getRequest()->getParam('id', ''),
                  $this->getRequest()->getParam('code', '')
        );
    	return $result;
    }

    public function chartAction() {
        $result = $this->indexModel->getChart();
    	return $result;
    }

    public function bptAction() {
        $result = $this->indexModel->getBPT(
                  $this->getRequest()->getParam('id')
        );
    	return $result;
    }
}



