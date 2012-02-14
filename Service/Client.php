<?php

namespace Nodrew\Bundle\EmbedlyBundle\Service;

use Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments,
    Nodrew\Bundle\EmbedlyBundle\Connection\CurlResponse,
    Nodrew\Bundle\EmbedlyBundle\Connection\CurlConnection,
    Symfony\Component\HttpFoundation\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <hi@nodrew.com>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
abstract class Client
{
    protected $clientUri;
    protected $queryArguments;
    protected $connection;

    /**
     * @param string $key
     * @param array $defaultOptions
     */
    public function __construct($key, $timeout = 3, $defaultOptions = array())
    {
        if (!defined('static::CLIENT_URI')) {
            throw new \LogicException('The client class '.get_class($this).' should have the constant CLIENT_URI defined, but does not.');
        }

        $this->clientUri  = static::CLIENT_URI;
        $this->connection = new CurlConnection($timeout);

        $this->queryArguments = new QueryArguments((array) $defaultOptions);
        $this->queryArguments->setKey($key);
    }

    /**
     * Set the cURL connection object to use.
     *
     * @param mixed $conn
     */
    public function setCurlConnection($conn)
    {
        $this->connection = $conn;
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

        if (!$response = $this->connection->request(sprintf($this->clientUri, $queryArgs))) {
            return;
        }

        return $this->parseResponse($response);
    }

	/**
	 * Parse the given response JSON.
	 *
	 * @param CurlResponse $response
	 * @return array|null
	 */
	protected function parseResponse(CurlResponse $response)
	{
	    $this->checkResponse($response);

	    if (!$decoded = json_decode($response->getReturn(), true)) {
	        return;
        }

	    $factory = $this->getResponseFactory();

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
     * Check that the response is a valid one.
     *
     * @param CurlResponse $response
     */
    public function checkResponse(CurlResponse $response)
    {
        if ($response->get('http_code') && $response->get('http_code') != 200) {
            if (strpos('403: Forbidden - The provided key does not support this endpoint:', $response->getReturn()) === 0) {
                throw new \LogicException('The Embedly god does not smile upon you this day. It looks like your provider key does not have permission to access this endpoint. You may need to either upgrade to a paid account, or contact support: support@embed.ly.');
            }

            $response->setReturn($this->buildErrorReturn($response->get('http_code'), $response->getReturn()));
        }
    }

	/**
	 * Given the current response code, create and error response json type.
	 *
	 * @param int $code
	 * @return string
	 */
	protected function buildErrorReturn($code, $origReturn)
	{
	    return json_encode(array(
	        'type'            => 'error',
	        'error_code'      => $code,
	        'error_message'   => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : 'Unknown response code',
	        'original_return' => $origReturn,
	    ));
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
    
    /**
     * Get the Response factory object.
     *
     * @return \Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactoryInterface
     */
    abstract protected function getResponseFactory();
}