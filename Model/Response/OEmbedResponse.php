<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class OEmbedResponse extends MappedResponseAbstract
{
    /**@#+
     * The internal object properties.
     */
    protected $version;
    protected $type;
    protected $title;
    protected $description;
    protected $providerName;
    protected $providerUrl;
    protected $thumbnailWidth;
    protected $thumbnailHeight;
    protected $thumbnailUrl;
    protected $authorName;
    protected $authorUrl;
    protected $cacheAge;
    /**@#-*/


    /**
     * Get the version property.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the type property.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
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
     * Get the authorName property.
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Get the authorUrl property.
     *
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * Get the cacheAge property.
     *
     * @return string
     */
    public function getCacheAge()
    {
        return $this->cacheAge;
    }
    
    /**
     *  {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return array(
            'version'           => 'version',
            'type'              => 'type',
            'title'             => 'title',
            'description'       => 'description',
            'provider_name'     => 'providerName',
            'provider_url'      => 'providerUrl',
            'thumbnail_width'   => 'thumbnailWidth',
            'thumbnail_height'  => 'thumbnailHeight',
            'thumbnail_url'     => 'thumbnailUrl',
            'author_name'       => 'authorName',
            'author_url'        => 'authorUrl',
            'cache_age'         => 'cacheAge',
        );
    }
}
