<?php 

namespace Tx\Mailer;


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