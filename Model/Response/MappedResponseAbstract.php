<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package		Embedly
 * @author		Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
abstract class MappedResponseAbstract implements ResponseInterface
{
    /**
     * Map the standard response object from embedly into the proper local structure.
     *
     * @param stdClass $stdResponse
     */
    public function map($obj)
    {
        $mappings = $this->getFieldMappings();
        if (!is_array($mappings)) {
            throw new \LogicException('The method '.get_class($this).'::getFieldMappings() was supposed to return an array. See the documentation for an example of the proper response.');
        }
        
        foreach ($mappings as $from => $to) {
            if (isset($obj->$from)) {
                $this->$to = $obj->$from;
            }
        }
    }
    
    /**
     * Get the field mapping in an array form for how to map to the response 
     * object from the stdClass object retrieved from Embedly.
     *
     * Return should be an array formatted like:
     *
     * array(
     *     'stcClassProperty1' => 'MappedResponseProperty1',
     *     'stcClassProperty2' => 'MappedResponseProperty2',
     *     'stcClassProperty3' => 'MappedResponseProperty3',
     * );
     *
     * @return array
     */
    abstract protected function getFieldMappings();
}
