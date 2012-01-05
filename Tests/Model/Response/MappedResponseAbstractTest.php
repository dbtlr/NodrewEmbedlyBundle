<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Model\Response;

use Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract;

class MappedResponseAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract::getFieldMappings
     */
    public function testIfFieldMappingDoesNotReturnProperlyThenWillExplode()
    {
        $this->setExpectedException('LogicException');
        
        $data = array();
        
        $record = new MappedResponseAbstractTestMock;
        $record->map($data);
    }
    
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract::map
     */
    public function testWillMapFromArrayToObj()
    {
        $data = array('foo1' => 'val1', 'foo2' => 'val2');
        
        $record = new MappedResponseAbstractTestMock;
        $record->fieldMappings = array('foo1' => 'bar1', 'foo2' => 'bar2');
        $record->map($data);
        
        $this->assertSame($data['foo1'], $record->bar1);
        $this->assertSame($data['foo2'], $record->bar2);
    }
    
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract::map
     */
    public function testWillMapUnknownVariablesToUnknownParamter()
    {
        $data = array('foo1' => 'val1', 'foo2' => 'val2', 'unknown' => 'blah!');
        
        $record = new MappedResponseAbstractTestMock;
        $record->fieldMappings = array('foo1' => 'bar1', 'foo2' => 'bar2');
        $record->map($data);
        
        $this->assertSame(array('unknown' => $data['unknown']), $record->getUnknownProperties());
    }
}

/**
 * Mock class for Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract
 */
class MappedResponseAbstractTestMock extends MappedResponseAbstract
{
    public $fieldMappings;

    public function getType()
    {
        return 'mock';
    }

    protected function getFieldMappings()
    {
        return $this->fieldMappings;
    }
}
