<?php
namespace common\components\Solr\HttpTransport;

abstract class HttpTransportAbstract implements HttpTransportInterface
{	
	/**
	 * Our default timeout value for requests that don't specify a timeout
	 *
	 * @var float
	 */
	private $_defaultTimeout = false;
		
	/**
	 * Get the current default timeout setting (initially the default_socket_timeout ini setting)
	 * in seconds
	 *
	 * @return float
	 */
	public function getDefaultTimeout()
	{
		// lazy load the default timeout from the ini settings
		if ($this->_defaultTimeout === false)
		{
			$this->_defaultTimeout = (int) ini_get('default_socket_timeout');

			// double check we didn't get 0 for a timeout
			if ($this->_defaultTimeout <= 0)
			{
				$this->_defaultTimeout = 60;
			}
		}
		
		return $this->_defaultTimeout;
	}
	
	/**
	 * Set the current default timeout for all HTTP requests
	 *
	 * @param float $timeout
	 */
	public function setDefaultTimeout($timeout)
	{
		$timeout = (float) $timeout;
		
		if ($timeout >= 0)
		{
			$this->_defaultTimeout = $timeout;
		}
	}	
}