<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class PhotoResponse extends OEmbedResponse
{
    /**@#+
     * The internal object properties.
     */
    protected $url;
    protected $height;
    protected $width;
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
     * Get the height property.
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the width property.
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return parent::getFieldMappings() + array(
            'url'    => 'height',
            'height' => 'height',
            'width'  => 'width',
        );
    }
}
