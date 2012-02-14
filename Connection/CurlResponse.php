<?php

namespace Nodrew\Bundle\EmbedlyBundle\Connection;

use Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <hi@nodrew.com>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class CurlResponse extends ParameterBag
{
    protected $return;

    /**
     * Build the object, setting the timeout properly.
     *
     * @param string $return
     */
    public function __construct($return, array $info = array())
    {
        $this->return     = $return;
        $this->parameters = array();

        foreach ($info as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Set the value that curl returned.
     *
     * @param string $return
     */
    public function setReturn($return)
    {
        $this->return = $return;
    }

    /**
     * Get the value that curl returned.
     *
     * @return string
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @see CurlResponse::getReturn()
     * @return string
     */
    public function __toString()
    {
        return $this->getReturn();
    }

    /**
     * Get the HTTP Message related to the http_code in the parameter bag, if any.
     *
     * @return string
     */
    public function getHttpMessage()
    {
        $code = $this->get('http_code');

        return isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : 'Unknown response code';
    }
}
