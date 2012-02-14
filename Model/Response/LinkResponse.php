<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <hi@nodrew.com>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class LinkResponse extends OEmbedResponse
{
    /**@#+
     * The internal object properties.
     */
    protected $url;
    /**@#-*/


    /**
     * Get the url property.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return parent::getFieldMappings() + array(
            'url'    => 'url',
        );
    }
}
