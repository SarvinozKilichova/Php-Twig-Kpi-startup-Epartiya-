<?php namespace Application\Paynet\Classes\Types;

/**
 * GetInformationArguments
 */
class GetInformationArguments extends GenericArguments {
	/**
	 * @access public
	 * @var GenericParam[]
	 */
	public $parameters;
	/**
	 * @access public
	 * @var integer
	 */
	public $serviceId;
}