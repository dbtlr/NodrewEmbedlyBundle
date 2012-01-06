<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Factory;

use Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory;

class OEmbedFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory::buildResponse
     */
     public function testWillBuildLinkModelProperly()
     {
         $factory = new OEmbedFactory;
         $model = $factory->buildResponse(array('type' => 'link'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\LinkResponse', get_class($model));
     }
     
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory::buildResponse
     */
     public function testWillBuildPhotoModelProperly()
     {
         $factory = new OEmbedFactory;
         $model = $factory->buildResponse(array('type' => 'photo'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\PhotoResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory::buildResponse
     */
     public function testWillBuildVideoModelProperly()
     {
         $factory = new OEmbedFactory;
         $model = $factory->buildResponse(array('type' => 'video'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\VideoResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory::buildResponse
     */
     public function testWillBuildRichModelProperly()
     {
         $factory = new OEmbedFactory;
         $model = $factory->buildResponse(array('type' => 'rich'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\RichResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory::buildResponse
     */
     public function testWillBuildErrorModelProperly()
     {
         $factory = new OEmbedFactory;
         $model = $factory->buildResponse(array('type' => 'error'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\ErrorResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\OEmbedFactory::buildResponse
     */
     public function testWillBuildGenericModelWhenTypeIsUnknown()
     {
         $factory = new OEmbedFactory;
         $model = $factory->buildResponse(array('type' => 'unknown'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\GenericResponse', get_class($model));
         $this->assertEquals('unknown', $model->getType());
     }
}