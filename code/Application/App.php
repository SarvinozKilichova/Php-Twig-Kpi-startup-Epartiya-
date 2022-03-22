<?php

class Application_App {

    protected static $_root;
    protected static $_modelLoader;
    protected $_dispatcher;
    protected $_request;
    protected $_log;
    protected $_adapter;
    protected $_gateway;
    protected $_config;
    protected $_template;
    protected $_session;
    protected $_data;
    protected $_response;
    protected $_error = null;
    protected $_helper;

    public function __construct($root)
    {
        if(is_null($root)) {
            $root = realpath(__DIR__ . '/../../../');
        }
        self::$_root = $root;

        return $this;
    }

    public function __destruct() {
        $this->_session->unsException();
    }

    public static function getRoot()
    {
        return self::$_root;
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public function init()
    {
        $dev = $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '.dev' : '';

        $this->_config     = new Application_Misc_Config(Application_App::getRoot() . '/config/config.ini');
        $this->_log        = new Application_Misc_Log(Application_App::getRoot() . '/var/log');
        $this->_dispatcher = new Application_Http_Dispatcher;
        $this->_request    = new Application_Http_Request;
        $this->_response   = new Application_Http_Response;
        $this->_session    = new Application_Http_Session;
        $databaseFactory   = new Application_Database_Factory;
        $this->_adapter    = $databaseFactory->getAdapter($this->_config, $dev);
        $this->_helper   = new Application_Misc_Helper;
		
		$this->_template   = new Application_Misc_Template($this->_config,
            $this->_log,
            $this->_session,
            $this->_request,
            $this->_dispatcher);
		
        $this->_gateway    = new Application_Gateway($this->_config,
            $this->_log,
			$this->_adapter,
			$this->_request,
            $this->_dispatcher,
			$this->_response,
			$this->_session,
			$this->_template,
            $this->_helper);
        $this->_log->setLevel(Application_Misc_Log::LOGLEVEL_DEBUG);

        self::$_modelLoader = new Application_Misc_ModelLoader($this->_session, $this->_config, $this->_adapter);
        return $this;
    }

    public function run()
    {

        $this->_request->checkRequiredPages($this->_session);
        $this->_dispatcher->dispatch(
            $this->_config->read('app/default_controller'),
            $this->_session->getLogged()
        );

        $serviceKey = $this->_dispatcher->getServiceKey();
		$action = $this->_dispatcher->getAction();

        $params = array($_GET, $this->_dispatcher->getUriParams());
        $params = call_user_func_array('array_merge', $params);
		
        $this->_request->setParams($params);

        try {
            $this->_data = $this->_gateway->proxy($serviceKey, $action);

            $language = is_null($this->_session->getLanguage()) ?
                $this->_config->read('app/default_language') :
                $this->_session->getLanguage();

            Application_Misc_Locale::load($language);

        } catch(Exception $e) {
            $this->_log->log($e->getTraceAsString(), "exception");
            $this->_session->setException($e);
        }

        $this->_response->setTemplateSystem(
            $this->_template->init($serviceKey, $action)
        );

        $outputFormat = $this->_response->getOutputFormat(
            $this->_request->getAcceptType()
        );
        $this->_response->setFormat($outputFormat)
            ->setBody($this->_data)
            ->out();
    }

    public static function redirect($url) {
        header("Location: {$url}");
        exit();
    }

    public static function getModel($modelName) {
        return self::$_modelLoader->load($modelName);
    }

}