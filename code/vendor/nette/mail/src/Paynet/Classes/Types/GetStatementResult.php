<?php namespace Application\Paynet\Classes\Types;
/**
 * GetStatementResult
 */
class GetStatementResult extends GenericResult {
	/**
	 * @access public
	 * @var TransactionStatement[]
	 */
	public $statements;
}