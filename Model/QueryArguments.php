<?php
namespace NoDrew\Bundle\EmbedlyBundle\Model;

use NoDrew\Bundle\EmbedlyBundle\Exception\ParameterMatchException;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class QueryArguments
{
    protected $key       = null;
    protected $url       = null;
    protected $urls      = null;
    protected $maxwidth  = null;
    protected $maxheight = null;
    protected $width     = null;
    protected $format    = 'json';
    protected $wmode     = 'opaque';
    protected $nostyle   = false;
    protected $autoplay  = false;
    protected $videosrc  = false;
    protected $words     = 50;
    protected $chars     = null;

    /**
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->load($data);
    }

    /**
     * Load the given array of data into the parameters.
     *
     * @param array $data
     */
    public function load(array $data)
    {
        foreach ($data as $key => $value) {
            $func = 'set'.ucfirst($key);
            if (method_exists($this, $func)) {
                $this->$func($value);
            }
        }
    }

    /**
     * Build the object as a query string.
     *
     * @return string
     */
    public function toQueryString()
    {
        $vars   = get_object_vars($this);
        $params = array();

        foreach ($vars as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            $params[$key] = $value;
        }

        return http_build_query($params);
    }

    /**
     * Call the toQueryString() method.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toQueryString();
    }

    /**
     * Set the key parameter.
     *
     * @param string $key
     */
    public function setKey($key)
    {
        if (!is_string($key)) {
            throw new ParameterException('key', 'string');
        }

        $this->key = $key;
    }

    /**
     * Get the key parameter
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the url parameter.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        if (!is_string($url)) {
            throw new ParameterException('url', 'string');
        }

        $this->url = $url;
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
     * Set the urls parameter.
     *
     * @param array $urls
     */
    public function setUrls($urls)
    {
        if (!is_array($urls)) {
            throw new ParameterException('urls', 'array');
        }

        $this->urls = implode(',', $urls);
    }

    /**
     * Get the urls parameter
     *
     * @return string
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Set the maxwidth parameter.
     *
     * @param int|null $maxwidth
     */
    public function setMaxwidth($maxwidth)
    {
        if (!is_null($maxwidth) || !is_int($maxwidth)) {
            throw new ParameterException('maxwidth', 'integer or null');
        }

        $this->maxwidth = $maxwidth;
    }

    /**
     * Get the maxwidth parameter
     *
     * @return int|null
     */
    public function getMaxwidth()
    {
        return $this->maxwidth;
    }

    /**
     * Set the maxheight parameter.
     *
     * @param int|null $maxheight
     */
    public function setMaxheight($maxheight)
    {
        if (!is_null($maxheight) || !is_int($maxheight)) {
            throw new ParameterException('maxheight', 'integer or null');
        }

        $this->maxheight = $maxheight;
    }

    /**
     * Get the maxheight parameter
     *
     * @return int|null
     */
    public function getMaxheight()
    {
        return $this->maxheight;
    }

    /**
     * Set the width parameter.
     *
     * @param int|null $width
     */
    public function setWidth($width)
    {
        if (!is_null($width) || !is_int($width)) {
            throw new ParameterException('width', 'integer or null');
        }

        $this->width = $width;
    }

    /**
     * Get the width parameter
     *
     * @return int|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the format parameter.
     *
     * @param string $format
     */
    public function setFormat($format)
    {
        if (!in_array($format, array('json', 'xml'))) {
            throw new ParameterException('format', 'json or xml');
        }

        $this->format = $format;
    }

    /**
     * Get the format parameter
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the wmode parameter.
     *
     * @param bool $wmode
     */
    public function setWmode($wmode)
    {
        if (!in_array($wmode, array('window', 'opaque', 'transparent'))) {
            throw new ParameterException('wmode', 'window, opaque or transparent');
        }

        $this->wmode = $wmode;
    }

    /**
     * Get the wmode parameter
     *
     * @return string
     */
    public function getWmode()
    {
        return $this->wmode;
    }

    /**
     * Set the nostyle parameter.
     *
     * @param bool $nostyle
     */
    public function setNostyle($nostyle)
    {
        if (!is_bool($nostyle)) {
            throw new ParameterException('nostyle', 'true or false');
        }

        $this->nostyle = $nostyle;
    }

    /**
     * Get the nostyle parameter
     *
     * @return bool
     */
    public function getNostyle()
    {
        return $this->nostyle;
    }

    /**
     * Set the autoplay parameter.
     *
     * @param bool $autoplay
     */
    public function setAutoplay($autoplay)
    {
        if (!is_bool($autoplay)) {
            throw new ParameterException('autoplay', 'true or false');
        }

        $this->autoplay = $autoplay;
    }

    /**
     * Get the autoplay parameter
     *
     * @return int|null
     */
    public function getAutoplay()
    {
        return $this->autoplay;
    }

    /**
     * Set the videosrc parameter.
     *
     * @param bool $videosrc
     */
    public function setVideosrc($videosrc)
    {
        if (!is_bool($videosrc)) {
            throw new ParameterException('videosrc', 'true or false');
        }

        $this->videosrc = $videosrc;
    }

    /**
     * Get the videosrc parameter
     *
     * @return int|null
     */
    public function getVideosrc()
    {
        return $this->videosrc;
    }

    /**
     * Set the words parameter.
     *
     * @param int|null $words
     */
    public function setWords($words)
    {
        if (!is_null($words) || !is_int($words)) {
            throw new ParameterException('words', 'int or null');
        }

        $this->words = $words;
    }

    /**
     * Get the words parameter
     *
     * @return int|null
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * Set the chars parameter.
     *
     * @param int|null $chars
     */
    public function setChars($chars)
    {
        if (!is_null($chars) || !is_int($chars)) {
            throw new ParameterException('chars', 'int or null');
        }

        $this->chars = $chars;
    }

    /**
     * Get the chars parameter
     *
     * @return int|null
     */
    public function getChars()
    {
        return $this->chars;
    }
}