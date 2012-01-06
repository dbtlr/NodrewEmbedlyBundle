<?php

namespace Nodrew\Bundle\EmbedlyBundle\Service;

use Nodrew\Bundle\EmbedlyBundle\Factory\ObjectifyFactory;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class ObjectifyClient extends Client
{
    const CLIENT_URI = 'http://api.embed.ly/2/objectify?%s';

    /**
     * {@inheritdoc}
     */
    protected function getResponseFactory()
    {
        return new ObjectifyFactory;
    }
}