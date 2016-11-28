<?php
namespace common\components\Solr\HttpTransport;


class HttpTransportCurl extends HttpTransportAbstract
{
	/**
	 * Curl Session Handle
	 *
	 * @var resource
	 */
	private $_curl;

	/**
	 * Initializes a curl session
	 */
	public function __construct()
	{
		$username = \Yii::$app->params['solr']['username'];
		$password = \Yii::$app->params['solr']['password'];
		// initialize a CURL session
		$this->_curl = curl_init();

		// set common options that will not be changed during the session
		curl_setopt_array($this->_curl, array(
			// return the response body from curl_exec
			CURLOPT_RETURNTRANSFER => true,

			// get the output as binary data
			CURLOPT_BINARYTRANSFER => true,

			// we do not need the headers in the output, we get everything we need from curl_getinfo
			CURLOPT_HEADER => false,
			
			CURLOPT_SSL_VERIFYPEER => false,
			
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			
			CURLOPT_USERPWD => "{$username}:{$password}"
		));
	}

	/**
	 * Closes a curl session
	 */
	function __destruct()
	{
		// close our curl session
		curl_close($this->_curl);
	}

	public function performGetRequest($url, $timeout = false)
	{
		// check the timeout value
		if ($timeout === false || $timeout <= 0.0)
		{
			// use the default timeout
			$timeout = $this->getDefaultTimeout();
		}

		// set curl GET options
		curl_setopt_array($this->_curl, array(
			// make sure we're returning the body
			CURLOPT_NOBODY => false,

			// make sure we're GET
			CURLOPT_HTTPGET => true,

			// set the URL
			CURLOPT_URL => $url,

			// set the timeout
			CURLOPT_TIMEOUT => $timeout
		));

		// make the request
		$responseBody = curl_exec($this->_curl);

		// get info from the transfer
		$statusCode = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($this->_curl, CURLINFO_CONTENT_TYPE);

		return new HttpTransportResponse($statusCode, $contentType, $responseBody);
	}

	public function performHeadRequest($url, $timeout = false)
	{
		// check the timeout value
		if ($timeout === false || $timeout <= 0.0)
		{
			// use the default timeout
			$timeout = $this->getDefaultTimeout();
		}

		// set curl HEAD options
		curl_setopt_array($this->_curl, array(
			// this both sets the method to HEAD and says not to return a body
			CURLOPT_NOBODY => true,

			// set the URL
			CURLOPT_URL => $url,

			// set the timeout
			CURLOPT_TIMEOUT => $timeout
		));

		// make the request
		$responseBody = curl_exec($this->_curl);

		// get info from the transfer
		$statusCode = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($this->_curl, CURLINFO_CONTENT_TYPE);

		return new HttpTransportResponse($statusCode, $contentType, $responseBody);
	}

	public function performPostRequest($url, $postData, $contentType, $timeout = false)
	{
		// check the timeout value
		if ($timeout === false || $timeout <= 0.0)
		{
			// use the default timeout
			$timeout = $this->getDefaultTimeout();
		}

		// set curl POST options
		curl_setopt_array($this->_curl, array(
			// make sure we're returning the body
			CURLOPT_NOBODY => false,

			// make sure we're POST
			CURLOPT_POST => true,

			// set the URL
			CURLOPT_URL => $url,

			// set the post data
			CURLOPT_POSTFIELDS => $postData,

			// set the content type
			CURLOPT_HTTPHEADER => array("Content-Type: {$contentType}"),

			// set the timeout
			CURLOPT_TIMEOUT => $timeout
		));

		// make the request
		$responseBody = curl_exec($this->_curl);

		// get info from the transfer
		$statusCode = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($this->_curl, CURLINFO_CONTENT_TYPE);

		return new HttpTransportResponse($statusCode, $contentType, $responseBody);
	}
}