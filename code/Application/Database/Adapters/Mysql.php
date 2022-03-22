<?php

class Application_Database_Adapters_Mysql extends Application_Database_Abstract {

	protected function dbConnect($params) {
		$connection = new mysqli($params['host'], $params['user'], $params['password'], $params['dbname']);
		return $connection;
	}
	
	public function dbDisconnect($connection) {
		return mysql_close($connection);
	}
	
	public function dbQuery($query, $connection) {
		return $connection->query($query);
	}

	public function dbMultiQuery($query, $connection) {
		return $connection->multi_query($query);
	}

	public function dbStoreResult($connection) {
		return $connection->store_result();
	}

    public function dbFetchAssoc($stmt) {
		if($stmt) {
			return mysqli_fetch_assoc( $stmt );
		}
    }

    public function dbFetchAllAssoc($result) {
		return $result->fetch_assoc();
    }

    public function dbFetchRow($stmt) {
        return mysql_fetch_row( $stmt );
    }
	
    public function dbNextResult($connection) {
		return $connection->next_result();
    }

    public function dbFreeStatement($stmt) {
        return mysql_free_statement( $stmt );
    }

    public function dbFreeResult($stmt) {
        return mysql_free_result( $stmt );
    }

}