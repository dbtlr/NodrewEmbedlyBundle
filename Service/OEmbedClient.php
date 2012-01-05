<?php

namespace Nodrew\Bundle\EmbedlyBundle\Service;

use Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments,
    Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory,
    Symfony\Component\HttpFoundation\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class OEmbedClient
{
    const CLIENT_URI = 'http://api.embed.ly/1/oembed?%s';
    protected $queryArguments;
    protected $timeout;

    /**
     * @param string $key
     * @param array $defaultOptions
     */
    public function __construct($key, $timeout = 3, $defaultOptions = array())
    {
        $this->timeout = $timeout;

        $this->queryArguments = new QueryArguments((array) $defaultOptions);
        $this->queryArguments->setKey($key);
    }

    /**
     * Fetch from embedly, based on the given url(s). If multiple are given in an array, then an array of responses will be returned.
     * 
     * @param string|array $url
     * @return array|null
     */
    public function fetch($url)
    {
        $queryArgs = clone $this->queryArguments;
        
        if (is_array($url)) {
            $queryArgs->setUrls($url);

        } else {
            $queryArgs->setUrl($url);
        }

        if (!$response = $this->request($queryArgs)) {
            return;
        }
        
        return $this->parseResponse($response);
    }

	/**
	 * @param Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments $queryParams
	 * @return string
	 **/
	protected function request(QueryArguments $queryArgs)
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, sprintf(self::CLIENT_URI, $query));
		curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($curl);
        $code   = curl_getinfo($curl, CURLINFO_HTTP_CODE);
 
		curl_close($curl);
        
        if ($code != 200) {
            $return = $this->buildErrorReturn($code);
        }

		return $return;
	}
	
	/**
	 * Given the current response code, create and error response json type.
	 *
	 * @param int $code
	 * @return stringr
	 */
	protected function buildErrorReturn($code)
	{
	    return json_encode(array(
	        'type'          => 'error',
	        'error_code'    => $code,
	        'error_message' => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : 'Unknown response code',
	    ));
    }

	/**
	 * Parse the given response JSON.
	 *
	 * @param string $textResponse
	 * @return array|null
	 */
	protected function parseResponse($textResponse)
	{
	    if (!$decoded = json_decode($textResponse, true)) {
	        return;
        }

	    $factory  = new ResponseFactory;

	    if (!$this->hasMultipleResponses($decoded)) {
	        return $factory->buildResponse($decoded);
        }

        $responses = array();
        foreach ($decoded as $response) {
            $responses[] = $factory->buildResponse($response);
        }

        return $responses;
    }
    
    /**
     * Check to see if the given response has multiple records in it.
     *
     * @param array $response
     * @return bool
     */
    protected function hasMultipleResponses($response)
    {
        return array_keys($response) === range(0, count($response) - 1);
    }    
}