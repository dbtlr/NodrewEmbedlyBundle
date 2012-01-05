<?php

namespace NoDrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class LinkResponse implements ResponseInterface
{
    protected function $url;
    protected function $title;
    protected function $description;
    protected function $providerName;
    protected function $providerUrl;
    protected function $thumbnailWidth;
    protected function $thumbnailHeight;
    protected function $thumbnailUrl;
    protected function $providerUrl;

    /**
     * {@inheritDoc}
     */
    public function map($stdResponse)
    {
        pre_r($stdResponse);
    }
}
