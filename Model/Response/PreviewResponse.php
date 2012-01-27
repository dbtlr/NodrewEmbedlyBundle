<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class PreviewResponse extends MappedResponseAbstract
{
    /**@#+
     * The internal object properties.
     */
    protected $type;
    protected $safe;
    protected $url;
    protected $originalUrl;
    protected $title;
    protected $description;
    protected $providerName;
    protected $providerUrl;
    protected $providerDisplay;
    protected $authorName;
    protected $authorUrl;
    protected $cacheAge;
    protected $faviconUrl;
    protected $object;
    protected $images;
    protected $content;
    protected $place;
    protected $event;
    protected $embeds;
    /**@#-*/


    /**
     * Get the type parameter
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the safe parameter
     *
     * @return string
     */
    public function getSafe()
    {
        return $this->safe;
    }

    /**
     * Get the url parameter
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the originalUrl parameter
     *
     * @return string
     */
    public function getOriginalUrl()
    {
        return $this->originalUrl;
    }

    /**
     * Get the title parameter
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the description parameter
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the providerName parameter
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * Get the providerUrl parameter
     *
     * @return string
     */
    public function getProviderUrl()
    {
        return $this->providerUrl;
    }

    /**
     * Get the providerDisplay parameter
     *
     * @return string
     */
    public function getProviderDisplay()
    {
        return $this->providerDisplay;
    }

    /**
     * Get the authorName parameter
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Get the authorUrl parameter
     *
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * Get the faviconUrl parameter
     *
     * @return string
     */
    public function getFaviconUrl()
    {
        return $this->faviconUrl;
    }

    /**
     * Get the images parameter
     *
     * @param array $images
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }

    /**
     * Get the images parameter
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Get the place parameter
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Get the event parameter
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get the embeds parameter
     *
     * @return string
     */
    public function getEmbeds()
    {
        return $this->embeds;
    }

    /**
     * Get the cacheAge parameter
     *
     * @return string
     */
    public function getCacheAge()
    {
        return $this->cacheAge;
    }

    /**
     * Get the object parameter
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Get the content parameter
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     *  {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return array(
            'type'              => 'type',
            'url'               => 'url',
            'original_url'      => 'originalUrl',
            'safe'              => 'safe',
            'title'             => 'title',
            'description'       => 'description',
            'provider_name'     => 'providerName',
            'provider_display'  => 'providerDisplay',
            'provider_url'      => 'providerUrl',
            'author_name'       => 'authorName',
            'author_url'        => 'authorUrl',
            'cache_age'         => 'cacheAge',
            'favicon_url'       => 'faviconUrl',
            'object'            => 'object',
            'images'            => 'images',
            'content'           => 'content',
            'place'             => 'place',
            'event'             => 'event',
            'embeds'            => 'embeds',
        );
    }
}
