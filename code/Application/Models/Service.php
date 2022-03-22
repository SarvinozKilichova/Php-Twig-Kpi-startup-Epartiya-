<?php

class Application_Models_Service extends Application_Lib_Varien_Object {

    public function getServices($merchant_id) {
    	return $this->getAdapter()->fetch('CABINET_BANK_INDOOR_MERCHANT_SERVICES_LIST ?, ?', array($this->getSession()->getSeskey(), $merchant_id));
    }

    public function addService($merchant_id, $phone_num) {
    	$data = $this->getAdapter()->fetch('[CABINET_BANK_INDOOR_MERCHANTS_SERVICE_ADD] ?, ?, ?', array($this->getSession()->getSeskey(), $merchant_id, $phone_num));
    	return $data[0];
    }

    public function updateService($service_id, $phone_number) {
        return $this->getAdapter()->fetch('CABINET_BANK_INDOOR_SERVICE_PHONE_CHANGE ?, ?', array($service_id, $phone_number));
    }

}