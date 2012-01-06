<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Factory;

use Nodrew\Bundle\EmbedlyBundle\Factory\ObjectifyFactory;

class ObjectifyFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ObjectifyFactory::buildResponse
     */
     public function testWillBuildPreviewModelProperly()
     {
         $factory = new ObjectifyFactory;
         $model = $factory->buildResponse(array('type' => 'html'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\ObjectifyResponse', get_class($model));
     }
}