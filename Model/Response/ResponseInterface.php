<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
interface ResponseInterface
{
    /**
     * Map the standard response object from embedly into the proper local structure.
     *
     * @param stdClass $stdResponse
     */
    public function map($stdResponse);
}