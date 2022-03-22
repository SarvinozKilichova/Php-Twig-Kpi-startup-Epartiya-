<?php

class Application_Misc_Log {

	const LOGLEVEL_ALL   = 7;
	const LOGLEVEL_ERROR = 4;
	const LOGLEVEL_WARN  = 2;
	const LOGLEVEL_DEBUG = 1;
	const LOGLEVEL_NONE  = 0;

	protected $_path  = '';
	protected $_level = 0;
	private $_data = array();

	public function __construct($path) {
		$this->_path  = $path;
	}
	
	public function __destruct () {
		$this->write();
	}

	public function setLevel($level) {
		$this->_level = (int) $level;
		return $this;
	}

	public function log($message, $level = self::LOGLEVEL_DEBUG) {

		if(!($level & $this->_level)) {
			return;
		}
		
		$prefix   = date('[Y-m-d H:i:s]: ');
		$message = preg_replace('#\r?\n#', "\n" . str_repeat(' ', 5), $message);
		
		array_push($this->_data, $prefix . $message);
	}

	public function logException(\Exception $e) {
		$this->log($e->__toString(), 'exception', self::LOGLEVEL_ERROR);
	}
	
	public function write() {
        if(count($this->_data) > 0) {
            $file = $this->_path . '/'.date('Y-m-d').'.log';
            $folder = dirname($file);

            @mkdir($folder, 755, true);
            file_put_contents($file, implode('', $this->_data) . "\r\n", FILE_APPEND);

            $this->_data = null;
        }
	}
}