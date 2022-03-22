<?php

class Application_Misc_Config {

	protected $_path   = '';
	protected $_config = null;

	public function __construct($path) {
		$this->_path = $path;
	}

	public function read($path, $default = null) {
		if(is_null($this->_config)) {
			$this->_load();
		}

		$parts = is_array($path) ? $path : explode('/', $path);

		$current = &$this->_config;

		foreach($parts as $part) {
			if(!is_array($current) || !array_key_exists($part, $current)) {
				return $default;
			}

			$current = &$current[$part];
		}

		return $current;
	}

	protected function _load() {
		$this->_config = parse_ini_file($this->_path, true, INI_SCANNER_RAW);
		array_walk_recursive($this->_config, function(&$value) {
			if(preg_match('#^\{(.+)\}$#', $value, $matches) && defined($matches[1])) {
				$value = constant($matches[1]);
			}
		});
	}
}