<?php

namespace Nodrew\Bundle\EmbedlyBundle\Factory;

use Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface,
    Nodrew\Bundle\EmbedlyBundle\Exception\ServiceException;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class ResponseFactory
{
    protected $validTypes = array('link', 'photo', 'video');

    /**
     * Build the appropriate response object, based on the requirement.
     *
     * @param stdClass $stdResponse
     * @return Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface
     */
    public function buildResponse($stdResponse)
    {
        if (!in_array($stdResponse->type, $this->validTypes)) {
            throw new ServiceException('An invalid type of: '.$stdResponse->type.' was returned by Embedly. I don\'t know what that is.');
        }

        $class   = 'Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\'.ucfirst($stdResponse->type).'Response';
        $response = new $class;
        $response->map($stdResponse);

        return $response;
    }
}
