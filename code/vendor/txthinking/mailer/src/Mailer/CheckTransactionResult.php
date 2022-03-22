<?php 

namespace Tx\Mailer;


/**
 * CheckTransactionResult
 */
class CheckTransactionResult extends GenericResult {
	/**
	 * @access public
	 * @var integer
	 */
	public $providerTrnId;
	/**
	 * @access public
	 * @var integer
	 */
	public $transactionState;
	public $transactionStateErrorStatus;
	public $transactionStateErrorMsg;
}