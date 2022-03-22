<?php

class Application_Models_Merchant extends Application_Lib_Varien_Object {

	/*
	[dbo].[REG_BANK_INDOOR_MERCHANTS_INSERT_TMP]
	  @name [nvarchar](80) NULL,
	  @short_name [nvarchar](80) NULL,
	  @boss_name [nvarchar](100) NULL,
	  @boss_type [nvarchar](50) NULL,
	  @address [nvarchar](100) NULL,
	  @address_legal [nvarchar](100) NULL,
	  @contract_number [varchar](20) NULL,
	  @contract_date [varchar](10) NULL, — dd.mm.yyyy
	  @mfo [varchar](5) NULL,
	  @mfo_transit [varchar](5) NULL,
	  @inn [varchar](9) NULL,
	  @accno [varchar](20) NULL,
	  @accno_transit [varchar](20) NULL,
	  — @okonx [nvarchar](10) NULL,
	  — @duet_branch [varchar](4) NULL,
	  @epos_merchant_id [varchar](24) NULL,
	  @epos_terminal_id [varchar](16) NULL,
	  @phone_number [varchar](12) NULL,
	  @region_code char(2) NULL
	*/
    public function registerMerchant($name, $short_name,  $boss_name, $boss_type, $address, $address_legal, $contract_number, $contract_date, $mfo, $mfo_transit, $inn, $accno, $accno_transit, $epos_merchant_id, $epos_terminal_id, $phone_number, $region_code) {
        $data = $this->getAdapter()->fetch('[CABINET_BANK_INDOOR_MERCHANTS_INSERT_TMP] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', array($this->getSession()->getSeskey(), $name, $short_name,  $boss_name, $boss_type, $address, $address_legal, $contract_number, $contract_date, $mfo, $mfo_transit, $inn, $accno, $accno_transit, $epos_merchant_id, $epos_terminal_id, "998".$phone_number, $region_code));
        return $data[0];
    }

    public function getRegions() {
        return $this->getAdapter()->fetch('CABINET_GET_SPR_REGION');
    }

    public function getMerchants() {
        return $this->getAdapter()->fetch('CABINET_BANK_INDOOR_MERCHANTS_USER_REPORT ?', array($this->getSession()->getSeskey()));
    }

    public function updateMerchant($merchent_id, $short_name) {
        return $this->getAdapter()->fetch('CABINET_BANK_INDOOR_MERCHANT_NICKNAME_CHANGE ?, ?, ?', array($this->getSession()->getSeskey(), $merchent_id, $short_name));
    }

}