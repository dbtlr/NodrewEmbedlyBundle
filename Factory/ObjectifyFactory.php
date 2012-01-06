<?php

namespace Nodrew\Bundle\EmbedlyBundle\Factory;

use Nodrew\Bundle\EmbedlyBundle\Model\Response\ObjectifyResponse;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class ObjectifyFactory implements ResponseFactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function buildResponse($embedlyResponse)
    {
        $response = new ObjectifyResponse;
        $response->map($embedlyResponse);

        return $response;
    }
}
