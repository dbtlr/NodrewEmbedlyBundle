<?php

namespace Nodrew\Bundle\EmbedlyBundle\Model\Response;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
abstract class MappedResponseAbstract implements ResponseInterface
{
    protected $unknownProperties = array();

    /**
     * Map the standard response from embedly into the proper local structure.
     *
     * @param array $embedlyResponse
     */
    public function map($embedlyResponse)
    {
        $mappings = $this->getFieldMappings();
        if (!is_array($mappings)) {
            throw new \LogicException('The method '.get_class($this).'::getFieldMappings() was supposed to return an array. See the documentation for an example of the proper response.');
        }
        
        foreach ($embedlyResponse as $key => $value) {
            if (!isset($mappings[$key])) {
                $this->unknownProperties[$key] = $value;
                continue;
            }

            $this->{$mappings[$key]} = $value;
        }
    }
    
    /**
     * Get an array of the unknown properties that were returned from embedly.
     *
     * - This is largely for debugging purposes. If something is in here, please create an issue to have it formally added into the Bundle.
     *
     * @return array
     */
    public function getUnknownProperties()
    {
        return $this->unknownProperties;
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