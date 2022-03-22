<?php 

namespace Tx\Mailer;

/**
 * CancelTransactionArguments
 */
class CancelTransactionArguments extends GenericArguments {
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