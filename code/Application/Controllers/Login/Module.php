<?php
use Telegram\Bot\Api;

class Application_Controllers_Login_Module extends Application_Controllers_ModelResource {
    public function indexAction() {
        
        if (isset($_COOKIE['userlogin'])) {
            $data['savelogin'] = 'checked';
            $data['login'] = base64_decode($_COOKIE['userlogin']);
        } else {
            $data['savelogin'] = '';
        }
        
   
   
        if($this->getRequest()->isPost()) {
        	$login = $this->getRequest()->getPost('login');
            $user = Application_App::getModel('user');
           
                $result = $user->login(
                    $login,
                    $this->getRequest()->getPost('password')
                );
                if ($result['result'] == 1 && $result['dl'] == 0) {
                	if ($result['kname'] == '') {
                		$this->getSession()->setKenName('Республика Сиёсий')->setLogged(1);
                	} else {
                		$this->getSession()->setKenName($result['kname'])->setLogged(1);
                	}
    	            if ($this->getRequest()->getPost('save_login')=='on') {
    	                setcookie('userlogin', base64_encode($login), time()+3600);
    	            } else {
    	                setcookie('userlogin', '');
    	            }           	
                	$this->getSession()->setSesskey($result['sesskey'])->setLogged(1);
                    $this->getSession()->setKenCod($result['kcode'])->setLogged(1);
                    $this->getSession()->setTCod($result['tcode'])->setLogged(1);
                    $this->getSession()->setRole($result['role'])->setLogged(1);
                    $this->getSession()->setLastEnter($result['lastenter'])->setLogged(1);
                    
                    Application_App::redirect('/');
                } else {
                	if ($result['result'] == 1) {
    		        	if ($result['dl'] > 0) {
    		            	if ($result['dl'] == 1) {
    
    		                        $append = '<p style="color: green;"><b>"'.$login.'" login uchun tasdiqlash kodi yuborildi!</b></p>'.
    		                        '<p>Tasdiqlash kodi: <b>'.$result['email'].'</b></p>'.
    		                        '<p>Agar bu xabar sizga talluqli bo\'lsama, iltimos bu xabarni o\'chirib yuboring</p>';
    
    		                        $body = file_get_contents('media/template/html/email.html');
    		                        $body = str_replace('{%message%}', $append, $body);
    		                    
    		                        $mail = $this->getMail($result['email']);
    		                        $mail->Subject = 'Икки босқичли кириш';
    		                        $mail->Body = $body;   
    		                        $mail->Send();	    
    		                       // print_r($mail);        		
    		            	} else {
    			            	if ($result['dl'] == 2) {
    			                    $telegram = new Api('1458668541:AAHdzv6_bba6UndQcL4yooRsyzsm2M2nbu8');
    			                    $telegram->sendMessage([ 'chat_id' => $result['telegramId'], 'parse_mode' => 'HTML', 'text' => 
    									"📋 EPartiya kabenitiga kirish uchun".chr(10).
    									"🔐 ".$login." logini uchun tasdiqlash kod:".$result['telegramId'] ]);                		
    			            	}
    		            	}
    
    		            	$this->getSession()->setLogin($login)->setTempLogged(1);
    		            	$this->getSession()->setVerify($result['dl'])->setTempLogged(1);
    		            	
    		            	Application_App::redirect('/verify');
    		        	}
                	} else {
                		$data['error'] = $result['msg_out'];
                	}
                }
          
        }
        return $data;
    }
}