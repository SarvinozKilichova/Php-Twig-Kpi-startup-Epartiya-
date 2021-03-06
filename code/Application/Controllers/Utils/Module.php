<?php

class Application_Controllers_Utils_Module extends Application_Controllers_ModelResource {
    public function logoutAction() {
        $this->getSession()->purge();
        Application_App::redirect('/');
    }
    
    public function unsetAction() {
        $this->getSession()->unsSuccess();
        $this->getSession()->unsError();
    }
}