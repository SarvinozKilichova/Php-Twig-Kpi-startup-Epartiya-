<?
require_once dirname(__DIR__)."/Http/Session.php";
abstract class Application_Database_Abstract {

	protected $_params;
	protected $_connection;
    protected $_session;
	
	abstract protected function dbConnect($params);
	abstract public function dbDisconnect($connection);
	abstract public function dbQuery($query, $connection);
	abstract public function dbMultiQuery($query, $connection);
	abstract public function dbStoreResult($connection);
	abstract public function dbFetchAssoc($stmt);
	abstract public function dbFetchAllAssoc($stmt);

	abstract public function dbFetchRow($stmt);
	abstract public function dbNextResult($stmt);
	abstract public function dbFreeStatement($stmt);
	abstract public function dbFreeResult($stmt);
	
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
        $this->_session = new Application_Http_Session;
		$this->_params = $params;
	}
	
	public function connect() {
		if(!$this->_connection) {
			$this->_connection = $this->dbConnect($this->_params);
		}
	}
	
	public function disconnect() {
		$this->dbDisconnect($this->_connection);
	}
	
	public function query($query, array $bind = null) {
		$this->connect();
		$query = $this->replace($query, $bind);
       	//echo $query."<br>";
        $stmt = $this->dbQuery($query, $this->_connection);
		return $stmt;
	}
	
	public function multiquery($query, array $bind = null) {
		$this->connect();
		$query = $this->replace($query, $bind);
       	//echo $query."<br>";
        $stmt = $this->dbMultiQuery($query, $this->_connection);
		return $stmt;
	}

	public function fetchAssoc($stmt) {
        $out = $this->dbFetchAssoc($stmt);
        if(is_array($out)) {
            foreach($out as $row => $value) {
				if($value instanceof DateTime) {
                    $value = $value->format('Y-m-d H:i:s');
                }
                $out[strtolower($row)] = $value;
            }
        }
        return $out;
    }
	
	public function fetchAll($query, array $bind = null) {
     	if ($stmt = $this->multiquery($query, $bind)) {
	        $out = array();
	        do {
	            $data = array();
	            if ($result = $this->dbStoreResult($this->_connection)) {
		            while($row = $this->dbFetchAllAssoc($result)) {
		                $data[] = $row;
		            }
		            $out[] = $data;
		        }
	        } while ($this->dbNextResult($this->_connection));
	       // print_r($out[0][0]["result"]);
	         if($out[0][0]["result"] == -31) {
	             $this->_session->purge();
	             Application_App::redirect("/login");
	         }	        
	        return $out;
     	}
    }
	
	public function fetch($query, array $bind = null) {
        $stmt = $this->query($query, $bind);
        while($result = $this->fetchAssoc($stmt)) {
            $out[] = $result;
        }

        /* Если сессия устарела */
        //print_r($out);
        //print_r('dddd');
        //print_r($out[0]["result"]);
         if($out[0]["result"] == -31) {
             $this->_session->purge();
             Application_App::redirect("/login");
         }

        return $out;
    }
	
	public function fetchRow($query, array $bind = null) {
		return $this->dbFetchRow($this->query($query, $bind));
	}
	
	private function replace($query, $bind) {
		if (!empty($bind)) {
			foreach($bind as $param) {
				$pos = strpos($query, '?');
				$array = str_split($query);
				$array[$pos] = is_string($param) ? $this->isnull($param) : $param;
				$query = implode($array);
			}
		}
		return $query;
	}

    private function isnull($value) {
        if($value == 'NULL') {
            return 'NULL';
        }
        return "'{$value}'";
    }
	
}