<?php

class Application_Gateway {
    protected $_config;
    protected $_log;
    protected $_adapter;
    protected $_request;
    protected $_dispatcher;
    protected $_response;
    protected $_template;
    protected $_helper;

    public function __construct(Application_Misc_Config $config, Application_Misc_Log $log, $adapter,
            Application_Http_Request $request,
            Application_Http_Dispatcher $dispatcher,
            Application_Http_Response $response,
            Application_Http_Session $session,
            Application_Misc_Template $template,
            Application_Misc_Helper $helper) {
        $this->_config  = $config;
        $this->_log  = $log;
        $this->_adapter = $adapter;
        $this->_request = $request;
        $this->_dispatcher = $dispatcher;
        $this->_response = $response;
        $this->_session = $session;
        $this->_template = $template;
        $this->_helper = $helper;
    }

    public function proxy($serviceKey, $method) {
        $service = $this->_serviceFactory($serviceKey);

        $service->setAdapter($this->_adapter)
            ->setRequest($this->_request)
            ->setDispatcher($this->_dispatcher)
            ->setConfig($this->_config)
            ->setLog($this->_log)
            ->setResponse($this->_response)
            ->setSession($this->_session)
            ->setTemplate($this->_template)
            ->setHelper($this->_helper);

        $method = !method_exists($service, $method . 'Action') ?
            $this->_config->read('app/default_action') :
            $method;

        $methodName = $method . 'Action';
        return $service->$methodName();
    }

    protected function _serviceFactory($serviceKey) {
        $className = 'Application_Controllers_'. $this->_config->read('routes/'. $serviceKey). '_Module';


        
        if(is_null($className) || !class_exists($className)) {
            throw new Exception('Page not found', 404);
        }
        $class = new $className;

        if(!$class instanceof Application_Controllers_ModelResource) {
            throw new LogicException('Forbidden', 403);
        }
        
        return $class;
    }

}