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
    protected $type;
    protected $code;
    protected $message;
    protected $originalReturn;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the message property.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get the originalReturn property.
     *
     * @return string
     */
    public function getOriginalReturn()
    {
        return $this->originalReturn;
    }

    /**
     * {@inheritDoc}
     */
    protected function getFieldMappings()
    {
        return array(
            'type'            => 'type',
            'error_code'      => 'code',
            'error_message'   => 'message',
            'original_return' => 'originalReturn',
        );
    }
}
