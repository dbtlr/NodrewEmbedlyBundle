<?php

namespace Nodrew\Bundle\EmbedlyBundle\Service;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class OEmbedClient extends Client
{
    const CLIENT_URI = 'http://api.embed.ly/1/oembed?%s';
}