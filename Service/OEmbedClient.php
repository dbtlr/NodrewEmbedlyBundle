<?php

namespace Nodrew\Bundle\EmbedlyBundle\Service;

use Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments,
    Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class OEmbedClient
{
    const CLIENT_URI = 'http://api.embed.ly/1/oembed?%s';
    protected $queryArguments;

    /**
     * @param string $key
     * @param array $defaultOptions
     */
    public function __construct($key, $defaultOptions = array())
    {
        $this->queryArguments = new QueryArguments((array) $defaultOptions);
        $this->queryArguments->setKey($key);
    }

    /**
     * Fetch from embedly, based on the given url(s). If multiple are given in an array, then an array of responses will be returned.
     * 
     * @param string|array $url
     * @return array
     */
    public function fetch($url)
    {
        $queryArgs = clone $this->queryArguments;
        
        if (is_array($url)) {
            $queryArgs->setUrls($url);

        } else {
            $queryArgs->setUrl($url);
        }

        $response = $this->request($queryArgs);
        return $this->parseResponse($response);
    }

	/**
	 * @param Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments $queryParams
	 * @return string
	 **/
	protected function request(QueryArguments $queryArgs)
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, sprintf(self::CLIENT_URI, $queryArgs));
		curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($curl);
		curl_close($curl);

		return $return;
	}

	/**
	 * Parse the given response JSON.
	 *
	 * @param string $textResponse
	 * @return array
	 */
	protected function parseResponse($textResponse)
	{
	    $factory  = new ResponseFactory;
	    $response = $factory->buildResponse(json_decode($textResponse));

	    return $response;
	    
    }
}