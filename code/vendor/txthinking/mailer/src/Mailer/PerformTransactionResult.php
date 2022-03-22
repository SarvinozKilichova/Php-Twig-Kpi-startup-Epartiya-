<?php 

namespace Tx\Mailer;

/**
 * PerformTransactionResult
 */
class PerformTransactionResult extends GenericResult {
	/**
	 * @access public
	 * @var GenericParam[]
	 */
	public $parameters;
	/**
	 * @access public
	 * @var integer
	 */
	public $providerTrnId;
}