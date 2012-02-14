<?php

namespace Nodrew\Bundle\EmbedlyBundle\Service;

use Nodrew\Bundle\EmbedlyBundle\Factory\PreviewFactory;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <hi@nodrew.com>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class PreviewClient extends Client
{
    const CLIENT_URI = 'http://api.embed.ly/1/preview?%s';

    /**
     * {@inheritdoc}
     */
    protected function getResponseFactory()
    {
        return new PreviewFactory;
    }
}