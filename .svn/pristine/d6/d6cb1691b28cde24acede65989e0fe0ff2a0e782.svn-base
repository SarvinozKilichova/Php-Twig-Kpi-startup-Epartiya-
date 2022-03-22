<?php

class Application_Database_Adapters_Mssql extends Application_Database_Abstract {

	protected function dbConnect($params) {
		$connection = mssql_connect($params['host'], $params['user'], $params['password']);
		if($connection) {
			mssql_select_db($params['dbname']);
		}
		
		return $connection;
	}
	
	public function dbDisconnect($connection) {
		return mssql_close($connection);
	}
	
	public function dbQuery($query, $connection) {
		return mssql_query($query, $connection);
	}

    public function dbFetchAssoc($stmt) {
		if($stmt) {
			return @mssql_fetch_assoc( $stmt );
		}
    }

    public function dbFetchRow($stmt) {
        return mssql_fetch_row( $stmt );
    }
	
    public function dbNextResult($stmt) {
		if($stmt) {
			return mssql_next_result( $stmt );
		}
    }

    public function dbFreeStatement($stmt) {
        return mssql_free_statement( $stmt );
    }

    public function dbFreeResult($stmt) {
        return mssql_free_result( $stmt );
    }
}