<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <hi@nodrew.com>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class ObjectifyResponse extends MappedResponseAbstract
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
    protected $faviconUrl;
    protected $images;
    protected $place;
    protected $event;
    protected $embeds;
    protected $meta;
    protected $openGraph;
    protected $entry;
    protected $microFormats;
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
     * @return string
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
     * Get the oembed parameter
     *
     * @return string
     */
    public function getOembed()
    {
        return $this->oembed;
    }

    /**
     * Get the meta parameter
     *
     * @return string
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Get the openGraph parameter
     *
     * @return string
     */
    public function getOpenGraph()
    {
        return $this->openGraph;
    }

    /**
     * Get the entry parameter
     *
     * @return string
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the microFormats parameter
     *
     * @return string
     */
    public function getMicroFormats()
    {
        return $this->microFormats;
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
            'favicon_url'       => 'faviconUrl',
            'images'            => 'images',
            'place'             => 'place',
            'event'             => 'event',
            'embeds'            => 'embeds',
            'oembed'            => 'oembed',
            'meta'              => 'meta',
            'open_graph'        => 'openGraph',
            'entry'             => 'entry',
            'microformats'      => 'microFormats',
        );
    }
}
