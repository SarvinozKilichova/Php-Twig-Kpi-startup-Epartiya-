<?php

class Application_Controllers_bpt_Module extends Application_Controllers_ModelResource {

	public function __construct() {
        $this->KenModel = Application_App::getModel('azolar');
        $this->bptModel = Application_App::getModel('bpt');
		$this->merchantFields = array(
			"fullname" => "Ф.И.О",
			"jins" => "Жинси",
			"millat" => "Миллати",
			"tsana" => "Туғуллан санаси",
			"passr" => "Паспорт серия ва рақами",
			"pasktb" => "Паспорт кийб томонидан берилган",
			"pasbv" => "Паспорт берилган вақти",
			"malumot" => "Маълумоти",
			"mutaxasis" => "Мутахассислиги"
		);
	}

    public function indexAction() {
        if ($this->getSession()->isLoggedIn()) {
        	$data['kname'] = $this->KenModel->getKname();
            $data['bpt'] = $this->bptModel->getBPT();
            $data['merchantFields'] = $this->merchantFields;
            return $data;
        }
    }

    public function registerAction()
    {
        if ($this->getSession()->isLoggedIn()) {
        	if ($this->getRequest()->isPost()) {
                $merchant_id = $this->getRequest()->getParam('merchant_id');
                if (!isset($merchant_id)) {
                    $name = $this->getRequest()->getParam('name');
                    $short_name = $this->getRequest()->getParam('short_name');
                    $boss_name  = $this->getRequest()->getParam('boss_name');
                    $boss_type  = $this->getRequest()->getParam('boss_type');
                    $address  = $this->getRequest()->getParam('address');
                    $address_legal  = $this->getRequest()->getParam('address_legal');
                    $contract_number = $this->getRequest()->getParam('contract_number');
                    $contract_date  = $this->getRequest()->getParam('contract_date');
                    $mfo  = $this->getRequest()->getParam('mfo');
                    $mfo_transit = $this->getRequest()->getParam('mfo_transit');
                    $inn  = $this->getRequest()->getParam('inn');
                    $accno  = $this->getRequest()->getParam('accno');
                    $accno_transit = $this->getRequest()->getParam('accno_transit');
                    $epos_merchant_id = $this->getRequest()->getParam('epos_merchant_id');
                    $epos_terminal_id = $this->getRequest()->getParam('epos_terminal_id');
                    $phone_number = $this->getRequest()->getParam('phone_number');
                    $region_code = $this->getRequest()->getParam('region_code');
                    $result = $this->merchantModel->registerMerchant($name, $short_name,  $boss_name, $boss_type, $address, $address_legal, $contract_number, $contract_date, $mfo, $mfo_transit, $inn, $accno, $accno_transit, $epos_merchant_id, $epos_terminal_id, $phone_number, $region_code);
                    if ($result['error'] == 0 || $result['success'] == 1) {
                        $this->getSession()->setSuccess('Поставщик успешно добавлен');
                        Application_App::redirect('register');
                    } else {
                        $data['merchant'] = $_POST;
                        if (isset($result['error_note'])) {
                            $data['error'] = $result['error_note'];
                        } else {
                            $data['error'] = "Ошибка! Пожалуйста, обратитесь к администраторам";
                        }
                    }
                } else {
                    /* Изменить данные поставщика */
                }
        	}
        	$data['regions'] = $this->merchantModel->getRegions();
        	return $data;
        }
    }

    public function exportAction() {
        if ($this->getSession()->isLoggedIn()) {
            $data['merchants'] = $this->merchantModel->getMerchants();

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            $sheet = $objPHPExcel->setActiveSheetIndex(0);

            // Add some data
            $sheet->setTitle("Поставщики");
            foreach (array_values($this->merchantFields) as $k => $v) {
                $sheet->setCellValue(chr(65+$k).'1', $v);
            }
            for ($i = 0; $i < sizeof($data['merchants']); $i++) {
                foreach (array_keys($this->merchantFields) as $k => $v) {
                    $field = $this->getHelper()->to_camel_case($v);
                    $sheet->setCellValue(chr(65+$k).($i + 2), $data['merchants'][$i][$field]);
                }
            }

            // Set columns width
            for ($i = 'A'; $i <= 'U'; $i++) {
                $sheet->getColumnDimension($i)->setWidth(20);
            }

            // Set styles
            $sheet->getStyle("A1:U1")->applyFromArray(
                array(
                    "font" => array(
                        "bold" => true
                    )
                )
            );
            $sheet->getStyle("A1:U".(sizeof($data['merchants']) + 1))->applyFromArray(
                array(
                    "alignment" => array(
                        "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        "wrap" => true
                    ),
                    "borders" => array(
                        "allborders" => array(
                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
            );

            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Список поставщиков.xls"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
    }

}