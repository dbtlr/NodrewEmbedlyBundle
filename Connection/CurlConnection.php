<?php

namespace Nodrew\Bundle\EmbedlyBundle\Connection;

use Symfony\Component\HttpFoundation\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class CurlConnection
{
    protected $timeout = 3;

    /**
     * Build the object, setting the timeout properly.
     *
     * @param int $timeout
     */
    public function __construct($timeout = 3)
    {
        $this->timeout = $timeout;
    }
    
	/**
	 * @param string $path
	 * @return string
	 **/
	public function request($path)
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $path);
		curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($curl);
        $info   = curl_getinfo($curl);
        
		curl_close($curl);
        
        $response = new CurlResponse($return, $info);

		return $response;
	}
}