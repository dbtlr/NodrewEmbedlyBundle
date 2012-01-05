<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class PhotoResponse extends MappedResponseAbstract
{
    /**@#+
     * The internal object properties.
     */
    protected $url;
    protected $title;
    protected $description;
    protected $providerName;
    protected $providerUrl;
    protected $thumbnailWidth;
    protected $thumbnailHeight;
    protected $thumbnailUrl;
    /**@#-*/
    
    /**
     * {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return array(
            'url'               => 'url', 
            'title'             => 'title', 
            'description'       => 'description', 
            'provider_name'     => 'providerName', 
            'provider_url'      => 'providerUrl', 
            'thumbnail_width'   => 'thumbnailWidth', 
            'thumbnail_height'  => 'thumbnailHeight', 
            'thumbnail_url'     => 'thumbnailUrl'
        );
    }
}
