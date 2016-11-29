<?php
namespace common\components\Solr\HttpTransport;

interface HttpTransportInterface
{
	/**
	 * Get the current default timeout for all HTTP requests
	 *
	 * @return float
	 */
	public function getDefaultTimeout();
	
	/**
	 * Set the current default timeout for all HTTP requests
	 *
	 * @param float $timeout
	 */
	public function setDefaultTimeout($timeout);
		
	/**
	 * Perform a GET HTTP operation with an optional timeout and return the response
	 * contents, use getLastResponseHeaders to retrieve HTTP headers
	 *
	 * @param string $url
	 * @param float $timeout
	 * @return HttpTransportResponse HTTP response
	 */
	public function performGetRequest($url, $timeout = false);
	
	/**
	 * Perform a HEAD HTTP operation with an optional timeout and return the response
	 * headers - NOTE: head requests have no response body
	 *
	 * @param string $url
	 * @param float $timeout
	 * @return HttpTransportResponse HTTP response
	 */
	public function performHeadRequest($url, $timeout = false);
	
	/**
	 * Perform a POST HTTP operation with an optional timeout and return the response
	 * contents, use getLastResponseHeaders to retrieve HTTP headers
	 *
	 * @param string $url
	 * @param string $rawPost
	 * @param string $contentType
	 * @param float $timeout
	 * @return HttpTransportResponse HTTP response
	 */
	public function performPostRequest($url, $rawPost, $contentType, $timeout = false);
}