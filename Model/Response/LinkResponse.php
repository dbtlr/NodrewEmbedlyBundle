<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class LinkResponse extends MappedResponseAbstract
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
     * Get the title property.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the description property.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


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
     * Get the providerName property.
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * Get the providerUrl property.
     *
     * @return string
     */
    public function getProviderUrl()
    {
        return $this->providerUrl;
    }

    /**
     * Get the thumbnailWidth property.
     *
     * @return string
     */
    public function getThumbnailWidth()
    {
        return $this->thumbnailWidth;
    }

    /**
     * Get the thumbnailHeight property.
     *
     * @return string
     */
    public function getThumbnailHeight()
    {
        return $this->thumbnailHeight;
    }

    /**
     * Get the thumbnailUrl property.
     *
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

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
