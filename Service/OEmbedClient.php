<?php

namespace NoDrew\Bundle\EmbedlyBundle\Service;
use NoDrew\Bundle\EmbedlyBundle\Model\QueryArguments;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class OEmbedClient
{
    const CLIENT_URI = 'http://api.embed.ly/1/oembed';
    protected $queryArguments;
    
    /**
     * @param string $apiKey
     * @param array $defaultOptions
     */
    public function __construct($apiKey, $defaultOptions = array())
    {
        pre_r($apiKey); exit;
        $this->queryArguments = new QueryArguments($defaultOptions);
        $this->queryArguments->setKey($key);
    }
    
    
}