<?php

namespace Nodrew\Bundle\EmbedlyBundle\Exception;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class ParameterMatchException extends \Exception
{
    const MESSAGE_TPL = "The parameter '%s' should match: %s. %s";
    
    /**
     * @param string    $name       The name of the parameter that failed.
     * @param string    $required   The requirements it should match.
     * @param string    $message    Optional message to append.
     * @param int       $code       The Exception code.
     * @param Exception $previous   The previous exception used for the exception chaining.
     */
    public function __construct($name, $required, $message = '', $code = 0, $previous = null)
    {
        $message = trim(sprintf(self::MESSAGE_TPL, $name, $required, $message));

        parent::__construct($message, $code, $previous);
    }
}
