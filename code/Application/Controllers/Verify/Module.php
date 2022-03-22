<?php
use Telegram\Bot\Api;

class Application_Controllers_Verify_Module extends Application_Controllers_ModelResource {

    public function indexAction() {

        if($this->getRequest()->isPost()) {
            $user = Application_App::getModel('user');
            $result = $user->verify(
                $code
            );
            if ($result['result'] == 1) {
            	$this->getSession()->setSesskey($result['sesskey'])->setLogged(1);
                $this->getSession()->setKenCod($result['kcode'])->setLogged(1);
                $this->getSession()->setKenName($result['kname'])->setLogged(1);
                Application_App::redirect('/');
            } else {
                $data['error'] = $result['msg_out'];
            }
        }
        $data['login'] = $this->getSession()->getLogin();
        $data['dl'] = $this->getSession()->getVerify();
        return $data;
    }
}