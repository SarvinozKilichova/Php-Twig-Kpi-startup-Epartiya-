<?php namespace Application\Paynet\Classes\Types;


/**
 * CheckTransactionArguments
 */
class CheckTransactionArguments extends GenericArguments {
	/**
	 * @access public
	 * @var integer
	 */
	public $serviceId;
	/**
	 * @access public
	 * @var integer
	 */
	public $transactionId;
}