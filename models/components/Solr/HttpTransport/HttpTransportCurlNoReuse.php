<?php
namespace common\components\Solr\HttpTransport;

class HttpTransportCurlNoReuse extends HttpTransportAbstract
{
	public function performGetRequest($url, $timeout = false)
	{
		// check the timeout value
		if ($timeout === false || $timeout <= 0.0)
		{
			// use the default timeout
			$timeout = $this->getDefaultTimeout();
		}
		
		$curl = curl_init();

		// set curl GET options
		curl_setopt_array($curl, array(
			// return the response body from curl_exec
			CURLOPT_RETURNTRANSFER => true,

			// get the output as binary data
			CURLOPT_BINARYTRANSFER => true,

			// we do not need the headers in the output, we get everything we need from curl_getinfo
			CURLOPT_HEADER => false,
			
			// set the URL
			CURLOPT_URL => $url,

			// set the timeout
			CURLOPT_TIMEOUT => $timeout
		));

		// make the request
		$responseBody = curl_exec($curl);

		// get info from the transfer
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
		
		// close our curl session - we're done with it
		curl_close($curl);

		return new TransportResponse($statusCode, $contentType, $responseBody);
	}

	public function performHeadRequest($url, $timeout = false)
	{
		// check the timeout value
		if ($timeout === false || $timeout <= 0.0)
		{
			// use the default timeout
			$timeout = $this->getDefaultTimeout();
		}
		
		$curl = curl_init();

		// set curl HEAD options
		curl_setopt_array($curl, array(
			// return the response body from curl_exec
			CURLOPT_RETURNTRANSFER => true,

			// get the output as binary data
			CURLOPT_BINARYTRANSFER => true,

			// we do not need the headers in the output, we get everything we need from curl_getinfo
			CURLOPT_HEADER => false,
			
			// this both sets the method to HEAD and says not to return a body
			CURLOPT_NOBODY => true,

			// set the URL
			CURLOPT_URL => $url,

			// set the timeout
			CURLOPT_TIMEOUT => $timeout
		));

		// make the request
		$responseBody = curl_exec($curl);

		// get info from the transfer
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
		
		// close our curl session - we're done with it
		curl_close($curl);

		return new TransportResponse($statusCode, $contentType, $responseBody);
	}

	public function performPostRequest($url, $postData, $contentType, $timeout = false)
	{
		// check the timeout value
		if ($timeout === false || $timeout <= 0.0)
		{
			// use the default timeout
			$timeout = $this->getDefaultTimeout();
		}

		$curl = curl_init();
		
		// set curl POST options
		curl_setopt_array($curl, array(
			// return the response body from curl_exec
			CURLOPT_RETURNTRANSFER => true,

			// get the output as binary data
			CURLOPT_BINARYTRANSFER => true,

			// we do not need the headers in the output, we get everything we need from curl_getinfo
			CURLOPT_HEADER => false,
			
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
		$responseBody = curl_exec($curl);

		// get info from the transfer
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);

		// close our curl session - we're done with it
		curl_close($curl);

		return new TransportResponse($statusCode, $contentType, $responseBody);
	}
}