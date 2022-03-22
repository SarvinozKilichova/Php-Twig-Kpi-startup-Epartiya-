<?php

class Application_Misc_Template {

    const DS = DIRECTORY_SEPARATOR;

    protected $_config;
    protected $_session;
    protected $_request;
    protected $_dispatcher;
    protected $_system;
    protected $_serviceKey;
    protected $_templateFile;
    protected $_defaults;
	protected $_loadfile;

    public function __construct(Application_Misc_Config $config,
        Application_Misc_Log $log,
        Application_Http_Session $session,
        Application_Http_Request $request,
        Application_Http_Dispatcher $dispatcher) {
        $this->_config = $config;
        $this->_log = $log;
        $this->_session = $session;
        $this->_request = $request;
        $this->_dispatcher = $dispatcher;
        $this->_defaults = $config->read('defaults');
    }

    public function init($serviceKey, $action) {
        $this->_serviceKey = $serviceKey;
        $this->_action = $action;

        try {
            $loader = new Twig_Loader_Filesystem(
                Application_App::getRoot() .
                self::DS .
                $this->_config->read('app/templates')
            );

            $twig = new Twig_Environment($loader, array(
//                'cache' => Application_App::getRoot() . self::DS. $this->_config->read('app/templates_cache'),
                'debug' => true
            ));

            $twig->getExtension('core')->setDateFormat($this->_defaults['date_format'], '%d days');
            $twig->getExtension('core')->setNumberFormat(2, ',', '');

            $filter = new Twig_SimpleFilter('print_r', 'print_r');
            $strlen = new Twig_SimpleFilter('strlen', 'strlen');
            $twig->addFilter($filter);
            $twig->addFilter($strlen);


            $this->_system = $twig;

        } catch(Exception $e) {
            $this->_log->log($e->getTraceAsString(), "exception");
            new Exception($e->getMessage());
        }

        return $this;
    }

    public function prepare($data) {
		if (!$this->_loadfile) {
			$templateFile = $this->getPage($this->_serviceKey, $this->_session->getException());
            if ($this->_action != 'index' && $this->_action != '') {
                $templateFile .= '_'.$this->_action;
            }
			$file = $this->_config->read('templates/'. $templateFile);
		} else {
			$file = $this->_loadfile;
		}
        $data = is_array($data) ? $data : array();
        $this->_templateFile = $this->_system->loadTemplate($file);

        $vars = $data;
        $vars['defaults'] = $this->_defaults;
        $vars['locale'] = Application_Misc_Locale::getAll();
        $vars['sys'] = array(
            'logged'    => $this->_session->getLogged(),
            'language'  => $this->_session->getLanguage(),
            'group'     => $this->_session->getGroup(),
            'fio'       => $this->_session->getFio(),
            'uid'       => $this->_session->getId(),
            'error'     => $this->_session->getError(),
            'success'   => $this->_session->getSuccess(),
            'info'      => $this->_session->getInfo(),
            'action'    => $this->_dispatcher->getAction(),
            'date'      => date($this->_defaults['date_format']),
            'page'      => $this->_serviceKey,
            'referer'   => $_SERVER['HTTP_REFERER']
        );
        $vars['defaults']['date_format'] = strtr(
            strtolower($this->_defaults['date_format']),
            array(
                'y' => 'yy',
                'm' => 'mm',
                'd' => 'dd'
            )
        );

        return $vars;
    }

    public function render($data) {
        try {
            return $this->_templateFile->render($data);
        } catch(Exception $e) {
            $this->_log->log($e->getTraceAsString(), "exception");
            return $e->getTraceAsString();
        }
    }

    private function getPage($serviceKey, $e) {
        if (!$e) {
            return $serviceKey;
        }
        if ($e->getCode() == 404) {
            return '404';
        }
        return 'error';
    }
	
	public function setFile($file) {
		$this->_loadfile = $file;
	}
} 