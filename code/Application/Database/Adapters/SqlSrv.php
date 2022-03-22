<?php

class Application_Database_Adapters_SqlSrv extends Application_Database_Abstract {

    protected function dbConnect($params) {

		$connectionInfo = array(
			"Database" => $params['dbname'],
			"UID" => $params['user'],
			"PWD" => $params['password'],
			"CharacterSet" => "UTF-8"
		);

		$connection = sqlsrv_connect($params['host'], $connectionInfo);
		if(!$connection) {
			new \Exception( print_r( sqlsrv_errors(), true));
		}
		return $connection;
    }

    public function dbDisconnect($connection) {
        return sqlsrv_close($connection);
    }
	
	public function dbQuery($query, $connection) {
        return sqlsrv_query($connection, $query);
    }
	
	public function dbFetchAssoc($stmt) {
		if($stmt) {
			return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
		}
    }
	
	public function dbFetchRow($stmt) {
        return sqlsrv_fetch($stmt);
    }
	
	public function dbNextResult($stmt) {
		if($stmt) {
			return sqlsrv_next_result($stmt);
        }
    }

    public function dbFreeStatement($stmt) {
        return sqlsrv_free_stmt( $stmt );
    }

    public function dbFreeResult($stmt) {
        return true;
    }
}