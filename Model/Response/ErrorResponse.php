<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class ErrorResponse extends MappedResponseAbstract
{
    /**@#+
     * The internal object properties.
     */
    protected $errorMessage;
    protected $errorCode;
    /**@#-*/


    /**
     * Get the errorMessage property.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Get the errorCode property.
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return array(
            'error_message' => 'errorMessage',
            'error_code'    => 'errorCode',
        );
    }
}
