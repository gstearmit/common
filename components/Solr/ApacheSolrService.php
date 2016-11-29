<?php
namespace common\components\Solr;

use common\components\Solr\HttpTransport\HttpTransportCurl;
use common\components\Solr\HttpTransport\HttpTransportInterface;
use Exception;

/**
 * @auth: huylx
 * ApacheSolrService
 */
class ApacheSolrService
{
	/**
	 * Response writer we'll request - JSON. See http://code.google.com/p/solr-php-client/issues/detail?id=6#c1 for reasoning
	 */
	const SOLR_WRITER = 'json';
	const SOLR_WRITER_PHP = 'php';

	/**
	 * NamedList Treatment constants
	 */
	const NAMED_LIST_FLAT = 'flat';
	const NAMED_LIST_MAP = 'map';

	/**
	 * Search HTTP Methods
	 */
	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';

	/**
	 * Servlet mappings
	 */
	const PING_SERVLET = 'admin/ping';
	const UPDATE_SERVLET = 'update';
	const SEARCH_SERVLET = 'select';
	const THREADS_SERVLET = 'admin/threads';
	const EXTRACT_SERVLET = 'update/extract';

	/**
	 * Server identification strings
	 *
	 * @var string
	 */
	public $_host, $_port, $_path;

	/**
	 * Whether {@link ApacheSolrResponse} objects should create {@link ApacheSolrDocument}s in
	 * the returned parsed data
	 *
	 * @var boolean
	 */
	public $_createDocuments = true;

	/**
	 * Whether {@link ApacheSolrResponse} objects should have multivalue fields with only a single value
	 * collapsed to appear as a single value would.
	 *
	 * @var boolean
	 */
	public $_collapseSingleValueArrays = true;

	/**
	 * How NamedLists should be formatted in the output.  This specifically effects facet counts. Valid values
	 * are {@link ApacheSolrService::NAMED_LIST_MAP} (default) or {@link ApacheSolrService::NAMED_LIST_FLAT}.
	 *
	 * @var string
	 */
	public $_namedListTreatment = self::NAMED_LIST_MAP;

	/**
	 * Query delimiters. Someone might want to be able to change
	 * these (to use &amp; instead of & for example), so I've provided them.
	 *
	 * @var string
	 */
	public $_queryDelimiter = '?', $_queryStringDelimiter = '&', $_queryBracketsEscaped = true;

	/**
	 * Constructed servlet full path URLs
	 *
	 * @var string
	 */
	public $_pingUrl, $_updateUrl, $_searchUrl, $_threadsUrl;

	/**
	 * Keep track of whether our URLs have been constructed
	 *
	 * @var boolean
	 */
	public $_urlsInited = false;

	/**
	 * HTTP Transport implementation (pluggable)
	 *
	 * @var Apache_Solr_HttpTransport_Interface
	 */
	public $_httpTransport = false;

	/**
	 * Escape a value for special query characters such as ':', '(', ')', '*', '?', etc.
	 *
	 * NOTE: inside a phrase fewer characters need escaped, use {@link ApacheSolrService::escapePhrase()} instead
	 *
	 * @param string $value
	 * @return string
	 */
	static public function escape($value)
	{
		//list taken from http://lucene.apache.org/java/docs/queryparsersyntax.html#Escaping%20Special%20Characters
		$pattern = '/(\+|-|&&|\|\||!|\(|\)|\{|}|\[|]|\^|"|~|\*|\?|:|\\\)/';
		$replace = '\\\$1';

		return preg_replace($pattern, $replace, $value);
	}

	/**
	 * Escape a value meant to be contained in a phrase for special query characters
	 *
	 * @param string $value
	 * @return string
	 */
	static public function escapePhrase($value)
	{
		$pattern = '/("|\\\)/';
		$replace = '\\\$1';

		return preg_replace($pattern, $replace, $value);
	}

	/**
	 * Convenience function for creating phrase syntax from a value
	 *
	 * @param string $value
	 * @return string
	 */
	static public function phrase($value)
	{
		return '"' . self::escapePhrase($value) . '"';
	}

	/**
	 * Constructor. All parameters are optional and will take on default values
	 * if not specified.
	 *
	 * @param string $host
	 * @param string $port
	 * @param string $path
	 * @param Apache_Solr_HttpTransport_Interface $httpTransport
	 */
	
	public function __construct($host = 'localhost', $port = 8180, $path = '/solr/', $httpTransport = false)
	{
		$this->setHost($host);
		$this->setPort($port);
		$this->setPath($path);

		$this->_initUrls();

		if ($httpTransport)
		{
			$this->setHttpTransport($httpTransport);
		}

		// check that our php version is >= 5.1.3 so we can correct for http_build_query behavior later
		$this->_queryBracketsEscaped = version_compare(phpversion(), '5.1.3', '>=');
	}

	/**
	 * Return a valid http URL given this server's host, port and path and a provided servlet name
	 *
	 * @param string $servlet
	 * @return string
	 */
	public function _constructUrl($servlet, $params = array())
	{
		if (count($params))
		{
			//escape all parameters appropriately for inclusion in the query string
			$escapedParams = array();

			foreach ($params as $key => $value)
			{
				$escapedParams[] = urlencode($key) . '=' . urlencode($value);
			}

			$queryString = $this->_queryDelimiter . implode($this->_queryStringDelimiter, $escapedParams);
		}
		else
		{
			$queryString = '';
		}

		return 'http://' . $this->_host . ':' . $this->_port . $this->_path . $servlet . $queryString;
	}

	/**
	 * Construct the Full URLs for the three servlets we reference
	 */
	public function _initUrls()
	{
		//Initialize our full servlet URLs now that we have server information
		$this->_extractUrl = $this->_constructUrl(self::EXTRACT_SERVLET);
		$this->_pingUrl = $this->_constructUrl(self::PING_SERVLET);
		$this->_searchUrl = $this->_constructUrl(self::SEARCH_SERVLET);
		$this->_threadsUrl = $this->_constructUrl(self::THREADS_SERVLET, array('wt' => self::SOLR_WRITER ));
		$this->_updateUrl = $this->_constructUrl(self::UPDATE_SERVLET, array('wt' => self::SOLR_WRITER ));

		$this->_urlsInited = true;
	}

	public function _generateQueryString($params)
	{
		// use http_build_query to encode our arguments because its faster
		// than urlencoding all the parts ourselves in a loop
		//
		// because http_build_query treats arrays differently than we want to, correct the query
		// string by changing foo[#]=bar (# being an actual number) parameter strings to just
		// multiple foo=bar strings. This regex should always work since '=' will be urlencoded
		// anywhere else the regex isn't expecting it
		//
		// NOTE: before php 5.1.3 brackets were not url encoded by http_build query - we've checked
		// the php version in the constructor and put the results in the instance variable. Also, before
		// 5.1.2 the arg_separator parameter was not available, so don't use it
		if ($this->_queryBracketsEscaped)
		{
			$queryString = http_build_query($params, null, $this->_queryStringDelimiter);
			return preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $queryString);
		}
		else
		{
			$queryString = http_build_query($params);
			return preg_replace('/\\[(?:[0-9]|[1-9][0-9]+)\\]=/', '=', $queryString);
		}
	}

	/**
	 * Central method for making a get operation against this Solr Server
	 *
	 * @param string $url
	 * @param float $timeout Read timeout in seconds
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If a non 200 response status is returned
	 */
	public function _sendRawGet($url, $timeout = FALSE){
		$httpTransport = $this->getHttpTransport();
		$httpResponse = $httpTransport->performGetRequest($url, $timeout);
		$solrResponse = new ApacheSolrResponse($httpResponse, $this->_createDocuments, $this->_collapseSingleValueArrays);
        if ($solrResponse->getHttpStatus() != 200)
		{
//			print_r($solrResponse);exit();
			//throw new \Exception($solrResponse);
		}
		return $solrResponse;
	}

	/**
	 * Central method for making a post operation against this Solr Server
	 *
	 * @param string $url
	 * @param string $rawPost
	 * @param float $timeout Read timeout in seconds
	 * @param string $contentType
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If a non 200 response status is returned
	 */
	public function _sendRawPost($url, $rawPost, $timeout = FALSE, $contentType = 'text/xml; charset=UTF-8')
	{
		$httpTransport = $this->getHttpTransport();
		
		$httpResponse = $httpTransport->performPostRequest($url, $rawPost, $contentType, $timeout);
		$solrResponse = new ApacheSolrResponse($httpResponse, $this->_createDocuments, $this->_collapseSingleValueArrays);
				
		if ($solrResponse->getHttpStatus() != 200)
		{
			////throw new \Exception($solrResponse);
		}
		return $solrResponse;
	}

	/**
	 * Returns the set host
	 *
	 * @return string
	 */
	public function getHost()
	{
		return $this->_host;
	}

	/**
	 * Set the host used. If empty will fallback to constants
	 *
	 * @param string $host
	 *
	 * @throws Exception If the host parameter is empty
	 */
	public function setHost($host)
	{
		//Use the provided host or use the default
		if (empty($host))
		{
			throw new Exception('Host parameter is empty');
		}
		else
		{
			$this->_host = $host;
		}

		if ($this->_urlsInited)
		{
			$this->_initUrls();
		}
	}

	/**
	 * Get the set port
	 *
	 * @return integer
	 */
	public function getPort()
	{
		return $this->_port;
	}

	/**
	 * Set the port used. If empty will fallback to constants
	 *
	 * @param integer $port
	 *
	 * @throws Exception If the port parameter is empty
	 */
	public function setPort($port)
	{
		//Use the provided port or use the default
		$port = (int) $port;

		if ($port <= 0)
		{
			throw new Exception('Port is not a valid port number');
		}
		else
		{
			$this->_port = $port;
		}

		if ($this->_urlsInited)
		{
			$this->_initUrls();
		}
	}

	/**
	 * Get the set path.
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->_path;
	}

	/**
	 * Set the path used. If empty will fallback to constants
	 *
	 * @param string $path
	 */
	public function setPath($path)
	{
		$path = trim($path, '/');

		$this->_path = '/' . $path . '/';

		if ($this->_urlsInited)
		{
			$this->_initUrls();
		}
	}

	/**
	 * Get the current configured HTTP Transport
	 *
	 * @return HttpTransportInterface
	 */
	public function getHttpTransport()
	{
		// lazy load a default if one has not be set
		if ($this->_httpTransport === false)
		{
			$this->_httpTransport = new HttpTransportCurl();
		}

		return $this->_httpTransport;
	}

	/**
	 * Set the HTTP Transport implemenation that will be used for all HTTP requests
	 *
	 * @param Apache_Solr_HttpTransport_Interface
	 */
	public function setHttpTransport(HttpTransportInterface $httpTransport)
	{
		$this->_httpTransport = $httpTransport;
	}

	/**
	 * Set the create documents flag. This determines whether {@link ApacheSolrResponse} objects will
	 * parse the response and create {@link ApacheSolrDocument} instances in place.
	 *
	 * @param boolean $createDocuments
	 */
	public function setCreateDocuments($createDocuments)
	{
		$this->_createDocuments = (bool) $createDocuments;
	}

	/**
	 * Get the current state of teh create documents flag.
	 *
	 * @return boolean
	 */
	public function getCreateDocuments()
	{
		return $this->_createDocuments;
	}

	/**
	 * Set the collapse single value arrays flag.
	 *
	 * @param boolean $collapseSingleValueArrays
	 */
	public function setCollapseSingleValueArrays($collapseSingleValueArrays)
	{
		$this->_collapseSingleValueArrays = (bool) $collapseSingleValueArrays;
	}

	/**
	 * Get the current state of the collapse single value arrays flag.
	 *
	 * @return boolean
	 */
	public function getCollapseSingleValueArrays()
	{
		return $this->_collapseSingleValueArrays;
	}

	/**
	 * Get the current default timeout setting (initially the default_socket_timeout ini setting)
	 * in seconds
	 *
	 * @return float
	 *
	 * @deprecated Use the getDefaultTimeout method on the HTTP transport implementation
	 */
	public function getDefaultTimeout()
	{
		return $this->getHttpTransport()->getDefaultTimeout();
	}

	/**
	 * Set the default timeout for all calls that aren't passed a specific timeout
	 *
	 * @param float $timeout Timeout value in seconds
	 *
	 * @deprecated Use the setDefaultTimeout method on the HTTP transport implementation
	 */
	public function setDefaultTimeout($timeout)
	{
		$this->getHttpTransport()->setDefaultTimeout($timeout);
	}

	/**
	 * Set how NamedLists should be formatted in the response data. This mainly effects
	 * the facet counts format.
	 *
	 * @param string $namedListTreatment
	 * @throws Exception If invalid option is set
	 */
	public function setNamedListTreatment($namedListTreatment)
	{
		switch ((string) $namedListTreatment)
		{
			case ApacheSolrService::NAMED_LIST_FLAT:
				$this->_namedListTreatment = ApacheSolrService::NAMED_LIST_FLAT;
				break;

			case ApacheSolrService::NAMED_LIST_MAP:
				$this->_namedListTreatment = ApacheSolrService::NAMED_LIST_MAP;
				break;

			default:
				throw new Ex('Not a valid named list treatement option');
		}
	}

	/**
	 * Get the current setting for named list treatment.
	 *
	 * @return string
	 */
	public function getNamedListTreatment()
	{
		return $this->_namedListTreatment;
	}

	/**
	 * Set the string used to separate the path form the query string.
	 * Defaulted to '?'
	 *
	 * @param string $queryDelimiter
	 */
	public function setQueryDelimiter($queryDelimiter)
	{
		$this->_queryDelimiter = $queryDelimiter;
	}

	/**
	 * Set the string used to separate the parameters in thequery string
	 * Defaulted to '&'
	 *
	 * @param string $queryStringDelimiter
	 */
	public function setQueryStringDelimiter($queryStringDelimiter)
	{
		$this->_queryStringDelimiter = $queryStringDelimiter;
	}

	/**
	 * Call the /admin/ping servlet, can be used to quickly tell if a connection to the
	 * server is able to be made.
	 *
	 * @param float $timeout maximum time to wait for ping in seconds, -1 for unlimited (default is 2)
	 * @return float Actual time taken to ping the server, FALSE if timeout or HTTP error status occurs
	 */
	public function ping($timeout = 2)
	{
		$start = microtime(true);
		
		$httpTransport = $this->getHttpTransport();
		
		$httpResponse = $httpTransport->performHeadRequest($this->_pingUrl, $timeout);
		
		$solrResponse = new ApacheSolrResponse($httpResponse, $this->_createDocuments, $this->_collapseSingleValueArrays);
		if ($solrResponse->getHttpStatus() == 200)
		{
			return microtime(true) - $start;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Call the /admin/threads servlet and retrieve information about all threads in the
	 * Solr servlet's thread group. Useful for diagnostics.
	 *
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function threads()
	{
		return $this->_sendRawGet($this->_threadsUrl);
	}

	/**
	 * Raw Add Method. Takes a raw post body and sends it to the update service.  Post body
	 * should be a complete and well formed "add" xml document.
	 *
	 * @param string $rawPost
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function add($rawPost)
	{
		return $this->_sendRawPost($this->_updateUrl, $rawPost);
	}

	/**
	 * Add a Solr Document to the index
	 *
	 * @param ApacheSolrDocument $document
	 * @param boolean $allowDups
	 * @param boolean $overwritePending
	 * @param boolean $overwriteCommitted
	 * @param integer $commitWithin The number of milliseconds that a document must be committed within, see @{link http://wiki.apache.org/solr/UpdateXmlMessages#The_Update_Schema} for details.  If left empty this property will not be set in the request.
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function addDocument(ApacheSolrDocument $document, $allowDups = false, $overwritePending = true, $overwriteCommitted = true, $commitWithin = 0)
	{
		$dupValue = $allowDups ? 'true' : 'false';
		$pendingValue = $overwritePending ? 'true' : 'false';
		$committedValue = $overwriteCommitted ? 'true' : 'false';
		
		$commitWithin = (int) $commitWithin;
		$commitWithinString = $commitWithin > 0 ? " commitWithin=\"{$commitWithin}\"" : '';
		
		$rawPost = "<add allowDups=\"{$dupValue}\" overwritePending=\"{$pendingValue}\" overwriteCommitted=\"{$committedValue}\"{$commitWithinString}>";
		$rawPost .= $this->_documentToXmlFragment($document);
		$rawPost .= '</add>';
		return $this->add($rawPost);
	}

	/**
	 * Add an array of Solr Documents to the index all at once
	 *
	 * @param array $documents Should be an array of ApacheSolrDocument instances
	 * @param boolean $allowDups
	 * @param boolean $overwritePending
	 * @param boolean $overwriteCommitted
	 * @param integer $commitWithin The number of milliseconds that a document must be committed within, see @{link http://wiki.apache.org/solr/UpdateXmlMessages#The_Update_Schema} for details.  If left empty this property will not be set in the request.
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function addDocuments($documents, $allowDups = false, $overwritePending = true, $overwriteCommitted = true, $commitWithin = 0)
	{
		$dupValue = $allowDups ? 'true' : 'false';
		$pendingValue = $overwritePending ? 'true' : 'false';
		$committedValue = $overwriteCommitted ? 'true' : 'false';

		$commitWithin = (int) $commitWithin;
		$commitWithinString = $commitWithin > 0 ? " commitWithin=\"{$commitWithin}\"" : '';

		$rawPost = "<add allowDups=\"{$dupValue}\" overwritePending=\"{$pendingValue}\" overwriteCommitted=\"{$committedValue}\"{$commitWithinString}>";

		foreach ($documents as $document)
		{
			if ($document instanceof ApacheSolrDocument)
			{
				$rawPost .= $this->_documentToXmlFragment($document);
			}
		}

		$rawPost .= '</add>';

		return $this->add($rawPost);
	}

	/**
	 * Create an XML fragment from a {@link ApacheSolrDocument} instance appropriate for use inside a Solr add call
	 *
	 * @return string
	 */
	public function _documentToXmlFragment(ApacheSolrDocument $document)
	{
		$xml = '<doc';

		if ($document->getBoost() !== false)
		{
			$xml .= ' boost="' . $document->getBoost() . '"';
		}

		$xml .= '>';

		foreach ($document as $key => $value)
		{
			$key = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
			$fieldBoost = $document->getFieldBoost($key);

			if (is_array($value))
			{
				foreach ($value as $multivalue)
				{
					$xml .= '<field name="' . $key . '"';

					if ($fieldBoost !== false)
					{
						$xml .= ' boost="' . $fieldBoost . '"';

						// only set the boost for the first field in the set
						$fieldBoost = false;
					}

					$multivalue = htmlspecialchars($multivalue, ENT_NOQUOTES, 'UTF-8');

					$xml .= '>' . $multivalue . '</field>';
				}
			}
			else
			{
				$xml .= '<field name="' . $key . '"';

				if ($fieldBoost !== false)
				{
					$xml .= ' boost="' . $fieldBoost . '"';
				}

				$value = htmlspecialchars($value, ENT_NOQUOTES, 'UTF-8');

				$xml .= '>' . $value . '</field>';
			}
		}

		$xml .= '</doc>';

		// replace any control characters to avoid Solr XML parser exception
		return $this->_stripCtrlChars($xml);
	}

	/**
	 * Replace control (non-printable) characters from string that are invalid to Solr's XML parser with a space.
	 *
	 * @param string $string
	 * @return string
	 */
	public function _stripCtrlChars($string)
	{
		// See:  http://w3.org/International/questions/qa-forms-utf-8.html
		// Printable utf-8 does not include any of these chars below x7F
		return preg_replace('@[\x00-\x08\x0B\x0C\x0E-\x1F]@', ' ', $string);
	}

	/**
	 * Send a commit command.  Will be synchronous unless both wait parameters are set to false.
	 *
	 * @param boolean $expungeDeletes Defaults to false, merge segments with deletes away
	 * @param boolean $waitFlush Defaults to true,  block until index changes are flushed to disk
	 * @param boolean $waitSearcher Defaults to true, block until a new searcher is opened and registered as the main query searcher, making the changes visible
	 * @param float $timeout Maximum expected duration (in seconds) of the commit operation on the server (otherwise, will throw a communication exception). Defaults to 1 hour
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function commit($expungeDeletes = false, $waitFlush = true, $waitSearcher = true, $timeout = 3600)
	{
		$expungeValue = $expungeDeletes ? 'true' : 'false';
		//$flushValue = $waitFlush ? 'true' : 'false';
		$searcherValue = $waitSearcher ? 'true' : 'false';

		//$rawPost = '<commit expungeDeletes="' . $expungeValue . '" waitFlush="' . $flushValue . '" waitSearcher="' . $searcherValue . '" />';
		$rawPost = '<commit expungeDeletes="' . $expungeValue . '" waitSearcher="' . $searcherValue . '" />';
		 
		return $this->_sendRawPost($this->_updateUrl, $rawPost, $timeout);
	}

	/**
	 * Raw Delete Method. Takes a raw post body and sends it to the update service. Body should be
	 * a complete and well formed "delete" xml document
	 *
	 * @param string $rawPost Expected to be utf-8 encoded xml document
	 * @param float $timeout Maximum expected duration of the delete operation on the server (otherwise, will throw a communication exception)
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function delete($rawPost, $timeout = 3600)
	{
		return $this->_sendRawPost($this->_updateUrl, $rawPost, $timeout);
	}

	/**
	 * Create a delete document based on document ID
	 *
	 * @param string $id Expected to be utf-8 encoded
	 * @param boolean $fromPending
	 * @param boolean $fromCommitted
	 * @param float $timeout Maximum expected duration of the delete operation on the server (otherwise, will throw a communication exception)
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function deleteById($id, $fromPending = true, $fromCommitted = true, $timeout = 3600)
	{
		$pendingValue = $fromPending ? 'true' : 'false';
		$committedValue = $fromCommitted ? 'true' : 'false';

		//escape special xml characters
		$id = htmlspecialchars($id, ENT_NOQUOTES, 'UTF-8');

		$rawPost = '<delete fromPending="' . $pendingValue . '" fromCommitted="' . $committedValue . '"><id>' . $id . '</id></delete>';

		return $this->delete($rawPost, $timeout);
	}

	/**
	 * Create and post a delete document based on multiple document IDs.
	 *
	 * @param array $ids Expected to be utf-8 encoded strings
	 * @param boolean $fromPending
	 * @param boolean $fromCommitted
	 * @param float $timeout Maximum expected duration of the delete operation on the server (otherwise, will throw a communication exception)
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function deleteByMultipleIds($ids, $fromPending = true, $fromCommitted = true, $timeout = 3600)
	{
		$pendingValue = $fromPending ? 'true' : 'false';
		$committedValue = $fromCommitted ? 'true' : 'false';

		$rawPost = '<delete fromPending="' . $pendingValue . '" fromCommitted="' . $committedValue . '">';

		foreach ($ids as $id)
		{
			//escape special xml characters
			$id = htmlspecialchars($id, ENT_NOQUOTES, 'UTF-8');

			$rawPost .= '<id>' . $id . '</id>';
		}

		$rawPost .= '</delete>';

		return $this->delete($rawPost, $timeout);
	}

	/**
	 * Create a delete document based on a query and submit it
	 *
	 * @param string $rawQuery Expected to be utf-8 encoded
	 * @param boolean $fromPending
	 * @param boolean $fromCommitted
	 * @param float $timeout Maximum expected duration of the delete operation on the server (otherwise, will throw a communication exception)
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function deleteByQuery($rawQuery, $fromPending = true, $fromCommitted = true, $timeout = 3600)
	{
		$pendingValue = $fromPending ? 'true' : 'false';
		$committedValue = $fromCommitted ? 'true' : 'false';

		// escape special xml characters
		$rawQuery = htmlspecialchars($rawQuery, ENT_NOQUOTES, 'UTF-8');

		$rawPost = '<delete fromPending="' . $pendingValue . '" fromCommitted="' . $committedValue . '"><query>' . $rawQuery . '</query></delete>';

		return $this->delete($rawPost, $timeout);
	}

	/**
	 * Use Solr Cell to extract document contents. See {@link http://wiki.apache.org/solr/ExtractingRequestHandler} for information on how
	 * to use Solr Cell and what parameters are available.
	 *
	 * NOTE: when passing an ApacheSolrDocument instance, field names and boosts will automatically be prepended by "literal." and "boost."
	 * as appropriate. Any keys from the $params array will NOT be treated this way. Any mappings from the document will overwrite key / value
	 * pairs in the params array if they have the same name (e.g. you pass a "literal.id" key and value in your $params array but you also
	 * pass in a document isntance with an "id" field" - the document's value(s) will take precedence).
	 *
	 * @param string $file Path to file to extract data from
	 * @param array $params optional array of key value pairs that will be sent with the post (see Solr Cell documentation)
	 * @param ApacheSolrDocument $document optional document that will be used to generate post parameters (literal.* and boost.* params)
	 * @param string $mimetype optional mimetype specification (for the file being extracted)
	 *
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception if $file, $params, or $document are invalid.
	 */
	public function extract($file, $params = array(), $document = null, $mimetype = 'application/octet-stream')
	{
		// check if $params is an array (allow null for default empty array)
		if (!is_null($params))
		{
			if (!is_array($params))
			{
				throw new Exception("\$params must be a valid array or null");
			}
		}
		else
		{
			$params = array();
		}
		
		// if $file is an http request, defer to extractFromUrl instead
		if (substr($file, 0, 7) == 'http://' || substr($file, 0, 8) == 'https://')
		{
			return $this->extractFromUrl($file, $params, $document, $mimetype);
		}
		
		// read the contents of the file
		$contents = @file_get_contents($file);

		if ($contents !== false)
		{
			// add the resource.name parameter if not specified
			if (!isset($params['resource.name']))
			{
				$params['resource.name'] = basename($file);
			}

			// delegate the rest to extractFromString
			return $this->extractFromString($contents, $params, $document, $mimetype);
		}
		else
		{
			throw new Exception("File '{$file}' is empty or could not be read");
		}
	}
	
	/**
	 * Use Solr Cell to extract document contents. See {@link http://wiki.apache.org/solr/ExtractingRequestHandler} for information on how
	 * to use Solr Cell and what parameters are available.
	 *
	 * NOTE: when passing an ApacheSolrDocument instance, field names and boosts will automatically be prepended by "literal." and "boost."
	 * as appropriate. Any keys from the $params array will NOT be treated this way. Any mappings from the document will overwrite key / value
	 * pairs in the params array if they have the same name (e.g. you pass a "literal.id" key and value in your $params array but you also
	 * pass in a document isntance with an "id" field" - the document's value(s) will take precedence).
	 *
	 * @param string $data Data that will be passed to Solr Cell
	 * @param array $params optional array of key value pairs that will be sent with the post (see Solr Cell documentation)
	 * @param ApacheSolrDocument $document optional document that will be used to generate post parameters (literal.* and boost.* params)
	 * @param string $mimetype optional mimetype specification (for the file being extracted)
	 *
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception if $file, $params, or $document are invalid.
	 *
	 * @todo Should be using multipart/form-data to post parameter values, but I could not get my implementation to work. Needs revisisted.
	 */
	public function extractFromString($data, $params = array(), $document = null, $mimetype = 'application/octet-stream')
	{
		// check if $params is an array (allow null for default empty array)
		if (!is_null($params))
		{
			if (!is_array($params))
			{
				//throw new \Exception("\$params must be a valid array or null");
			}
		}
		else
		{
			$params = array();
		}

		// make sure we receive our response in JSON and have proper name list treatment
		$params['wt'] = self::SOLR_WRITER;
		$params['json.nl'] = $this->_namedListTreatment;

		// check if $document is an ApacheSolrDocument instance
		if (!is_null($document) && $document instanceof ApacheSolrDocument)
		{
			// iterate document, adding literal.* and boost.* fields to $params as appropriate
			foreach ($document as $field => $fieldValue)
			{
				// check if we need to add a boost.* parameters
				$fieldBoost = $document->getFieldBoost($field);

				if ($fieldBoost !== false)
				{
					$params["boost.{$field}"] = $fieldBoost;
				}

				// add the literal.* parameter
				$params["literal.{$field}"] = $fieldValue;
			}
		}

		// params will be sent to SOLR in the QUERY STRING
		$queryString = $this->_generateQueryString($params);

		// the file contents will be sent to SOLR as the POST BODY - we use application/octect-stream as default mimetype
		return $this->_sendRawPost($this->_extractUrl . $this->_queryDelimiter . $queryString, $data, false, $mimetype);
	}
	
	/**
	 * Use Solr Cell to extract document contents. See {@link http://wiki.apache.org/solr/ExtractingRequestHandler} for information on how
	 * to use Solr Cell and what parameters are available.
	 *
	 * NOTE: when passing an ApacheSolrDocument instance, field names and boosts will automatically be prepended by "literal." and "boost."
	 * as appropriate. Any keys from the $params array will NOT be treated this way. Any mappings from the document will overwrite key / value
	 * pairs in the params array if they have the same name (e.g. you pass a "literal.id" key and value in your $params array but you also
	 * pass in a document isntance with an "id" field" - the document's value(s) will take precedence).
	 *
	 * @param string $url URL
	 * @param array $params optional array of key value pairs that will be sent with the post (see Solr Cell documentation)
	 * @param ApacheSolrDocument $document optional document that will be used to generate post parameters (literal.* and boost.* params)
	 * @param string $mimetype optional mimetype specification (for the file being extracted)
	 *
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception if $url, $params, or $document are invalid.
	 */
	public function extractFromUrl($url, $params = array(), $document = null, $mimetype = 'application/octet-stream')
	{
		// check if $params is an array (allow null for default empty array)
		if (!is_null($params))
		{
			if (!is_array($params))
			{
				//throw new \Exception("\$params must be a valid array or null");
			}
		}
		else
		{
			$params = array();
		}

		$httpTransport = $this->getHttpTransport();
		
		// read the contents of the URL using our configured Http Transport and default timeout
		$httpResponse = $httpTransport->performGetRequest($url);
		
		// check that its a 200 response
		if ($httpResponse->getStatusCode() == 200)
		{
			// add the resource.name parameter if not specified
			if (!isset($params['resource.name']))
			{
				$params['resource.name'] = $url;
			}

			// delegate the rest to extractFromString
			return $this->extractFromString($httpResponse->getBody(), $params, $document, $mimetype);
		}
		else
		{
			throw new Exception("URL '{$url}' returned non 200 response code");
		}
	}

	/**
	 * Send an optimize command.  Will be synchronous unless both wait parameters are set
	 * to false.
	 *
	 * @param boolean $waitFlush
	 * @param boolean $waitSearcher
	 * @param float $timeout Maximum expected duration of the commit operation on the server (otherwise, will throw a communication exception)
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 */
	public function optimize($waitFlush = true, $waitSearcher = true, $timeout = 3600)
	{
		//$flushValue = $waitFlush ? 'true' : 'false';
		$searcherValue = $waitSearcher ? 'true' : 'false';

		//$rawPost = '<optimize waitFlush="' . $flushValue . '" waitSearcher="' . $searcherValue . '" />';
		$rawPost = '<optimize waitSearcher="' . $searcherValue . '" />';

		return $this->_sendRawPost($this->_updateUrl, $rawPost, $timeout);
	}

	public function searchOne($key, $query="*:*", $method = self::METHOD_GET){
		// khoi tao params
		
		$params['wt'] = self::SOLR_WRITER;
		$params['q'] = $query;
		$params['fq'] = $key;
		
		
		$queryString = $this->_generateQueryString($params);
		
		if ($method == self::METHOD_GET){
			return $this->_sendRawGet($this->_searchUrl . $this->_queryDelimiter . $queryString);
		}
		else if ($method == self::METHOD_POST){
			return $this->_sendRawPost($this->_searchUrl, $queryString, FALSE, 'application/x-www-form-urlencoded; charset=UTF-8');
		}
		else{
			//throw new \Exception("Unsupported method '$method', please use the ApacheSolrService::METHOD_* constants");
		}
	}
	/**
	 * Simple Search interface
	 *
	 * @param string $query The raw query string
	 * @param int $offset The starting offset for result documents
	 * @param int $limit The maximum number of result documents to return
	 * @param array $params key / value pairs for other query parameters (see Solr documentation), use arrays for parameter keys used more than once (e.g. facet.field)
	 * @param string $method The HTTP method (ApacheSolrService::METHOD_GET or ApacheSolrService::METHOD::POST)
	 * @return ApacheSolrResponse
	 *
	 * @throws Exception If an error occurs during the service call
	 * @throws Exception If an invalid HTTP method is used
	 */
	public function search($query, $offset = 0, $limit = 10, $params = array(), $method = self::METHOD_GET)
	{
		// ensure params is an array
		$queryFacetString = "";
		
		if (!is_null($params)){
			if (!is_array($params)){}
			else{
				$queryFacetString = $this->getFacetQuery($params);
				unset($params);
			}
		}
		else{
			$params = array();
		}
		// construct our full parameters
		// common parameters in this interface
		$params['wt'] = self::SOLR_WRITER;
		//$params['json.nl'] = $this->_namedListTreatment;

		$params['q'] = $query;
		$params['start'] = $offset;
		$params['rows'] = $limit;
		
		$queryString = '';
		
		if($queryFacetString){
			$queryString = $this->_generateQueryString($params) .'&'.  $queryFacetString;
		}else{
			$queryString = $this->_generateQueryString($params);
		}
		
		if ($method == self::METHOD_GET){
			return $this->_sendRawGet($this->_searchUrl . $this->_queryDelimiter . $queryString);
		}
		else if ($method == self::METHOD_POST){
			return $this->_sendRawPost($this->_searchUrl, $queryString, FALSE, 'application/x-www-form-urlencoded; charset=UTF-8');
		}
		else{
			//throw new \Exception("Unsupported method '$method', please use the ApacheSolrService::METHOD_* constants");
		}
	}
	
	public function getFacetQuery($params = [], $queryFacetString = "facet=true"){
		if($params)foreach ($params as $param){
			$queryFacetString = $queryFacetString.'&facet.field='.$param;
		}
		return $queryFacetString;
	}
}