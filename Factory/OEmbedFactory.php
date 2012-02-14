<?php

namespace Nodrew\Bundle\EmbedlyBundle\Factory;

use Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface,
    Nodrew\Bundle\EmbedlyBundle\Exception\ServiceException;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <hi@nodrew.com>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class OEmbedFactory implements ResponseFactoryInterface
{
    protected $validTypes = array('link', 'photo', 'video', 'rich', 'error');

    /**
     * Build the appropriate response object, based on the requirement.
     *
     * @param array $embedlyResponse
     * @return Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface
     */
    public function buildResponse($embedlyResponse)
    {
        $type = $embedlyResponse['type'];
        if (!in_array($type, $this->validTypes)) {
            $type = 'oEmbed';
        }

        $class   = 'Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\'.ucfirst($type).'Response';
        $response = new $class;
        $response->map($embedlyResponse);

        return $response;
    }
}
