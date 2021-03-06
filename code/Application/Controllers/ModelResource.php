<?php
use PHPMailer\PHPMailer\PHPMailer;

class Application_Controllers_ModelResource {
    protected $_adapter;
    protected $_request;
    protected $_dispatcher;
    protected $_response;
    protected $_session;
    protected $_template;
    protected $_config;
    protected $_log;
    protected $_helper;

    /**
     * @param mixed $response
     * @return Application_Controllers_ModelResource
     */
    public function setResponse($response)
    {
        $this->_response = $response;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @param mixed $session
     * @return Application_Controllers_ModelResource
     */
    public function setSession($session)
    {
        $this->_session = $session;
		
		return $this;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->_session;
    }

    /**
     * @param mixed $adapter
     * @return Application_Controllers_ModelResource
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->_adapter;
    }

    /**
     * @param mixed $dispatcher
     * @return Application_Controllers_ModelResource
     */
    public function setRequest($request)
    {
        $this->_request = $request;

        return $this;
    }

    /**
     * @return Application_Http_Request;
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @param mixed $request
     * @return Application_Controllers_ModelResource
     */
    public function setDispatcher($dispatcher)
    {
        $this->_dispatcher = $dispatcher;

        return $this;
    }

    /**
     * @return Application_Http_Dispatcher;
     */
    public function getDispatcher()
    {
        return $this->_dispatcher;
    }

    /**
     * @param mixed $config
     * @return Application_Controllers_ModelResource
     */
    public function setConfig($config)
    {
        $this->_config = $config;

        return $this;
    }

    /**
     * @return Application_Misc_Config;
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * @param mixed $log
     * @return Application_Controllers_ModelResource
     */
    public function setLog($log)
    {
        $this->_log = $log;

        return $this;
    }

    /**
     * @return Application_Misc_Log;
     */
    public function getLog()
    {
        return $this->_log;
    }
	
	public function setTemplate($template)
    {
        $this->_template = $template;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->_template;
    }

    /**
     * @return array
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @param mixed $helper
     * @return Application_Controllers_ModelResource
     */
    public function setHelper($helper)
    {
        $this->_helper = $helper;

        return $this;
    }

    /**
     * @return Application_Misc_Helper;
     */
    public function getHelper()
    {
        return $this->_helper;
    }

    public function total_sum($array) {
        if (!empty($array)) {
            foreach($array[0] as $k => $v)
                $result[$k] = array_sum(array_column($array, $k));
            return $result;
        }
    }

    public function getMail($to) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'mail.epartiya.uz';

        $mail->Username = '_mainaccount@epartiya.uz';
        $mail->Password = 'qhPL94t5e6';

        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('verify@epartiya.uz', 'EPartiya');
        $mail->addAddress($to);
        $mail->isHTML(true);
        return $mail;
    }  

function calcutateAge($dob){

        $dob = date("Y-m-d",strtotime($dob));

        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();

        $diff = $dobObject->diff($nowObject);

        return $diff->y;

}

}