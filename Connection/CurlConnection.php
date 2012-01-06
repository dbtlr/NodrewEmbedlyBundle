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

        echo $path;
		curl_setopt($curl, CURLOPT_URL, $path);
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
}