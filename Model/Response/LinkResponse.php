<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class LinkResponse implements ResponseInterface
{
    protected $url;
    protected $title;
    protected $description;
    protected $providerName;
    protected $providerUrl;
    protected $thumbnailWidth;
    protected $thumbnailHeight;
    protected $thumbnailUrl;

    /**
     * {@inheritDoc}
     */
    public function map($stdResponse)
    {

    }
}
