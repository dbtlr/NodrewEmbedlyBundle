<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class ErrorResponse extends MappedResponseAbstract
{
    /**@#+
     * The internal object properties.
     */
    protected $code;
    protected $message;
    /**@#-*/


    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'error';
    }

    /**
     * Get the code property.
     *
     * @return string
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * Get the message property.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return array(
            'error_code'    => 'code',
            'error_message' => 'message',
        );
    }
}
