<?php

namespace Nodrew\Bundle\EmbedlyBundle\Factory;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
interface ResponseFactoryInterface
{
    /**
     * Build the appropriate response object, based on the requirement.
     *
     * @param array $embedlyResponse
     * @return Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface
     */
    public function buildResponse($embedlyResponse);
}