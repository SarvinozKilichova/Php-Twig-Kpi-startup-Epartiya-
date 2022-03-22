<?php

class Application_Database_Adapters_SqlSrvPdo {

	/**
	 * @var array
	 */
	protected $_params;

	/**
	 * @var \PDO
	 */
	protected $_pdo;

	public function __construct(array $params) {
		$requiredKeys = array(
			'host',
			'dbname',
			'user',
			'password'
        );

		$diff = array_diff($requiredKeys, array_keys($params));

		if(!empty($diff)) {
			throw new \RuntimeException('Database configuration missing values for: ' . implode(',', $diff));
		}

		$this->_params = $params;
	}

	public function connect() {
		if(!$this->_pdo) {
            $dbParams = array(
                $this->_params['host'],
                $this->_params['dbname'],
                $this->_params['user'],
                $this->_params['password']
            );
			//$dsn = vsprintf('odbc:Driver={SQL Server};Server=%s;Database=%s;Uid=%s;Pwd=%s', $dbParams);			
			$dsn = vsprintf($this->_params['dsn'], $dbParams);
			
			//$this->_pdo = new \PDO($dsn);
			
			$this->_pdo = new \PDO($dsn, $this->_params['user'], $this->_params['password']);
			$this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->_pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		}
	}

	public function disconnect() {
		$this->_pdo = null;
	}

	public function query($query, array $bind = null) {
		$this->connect();

		$stmt = $this->_pdo->prepare($query);
		$stmt->execute($bind);

		return $stmt;
	}

	public function fetchAll($query, array $bind = null) {
		return $this->query($query, $bind)->fetchAll();
	}

	public function fetchRow($query, array $bind = null) {
		return $this->query($query, $bind)->fetch();
	}

	public function fetchOne($query, array $bind = null) {
		return $this->query($query, $bind)->fetchColumn();
	}
}