<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Factory;

use Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory;

class ResponseFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory::buildResponse
     */
     public function testWillBuildLinkModelProperly()
     {
         $factory = new ResponseFactory;
         $model = $factory->buildResponse(array('type' => 'link'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\LinkResponse', get_class($model));
     }
     
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory::buildResponse
     */
     public function testWillBuildPhotoModelProperly()
     {
         $factory = new ResponseFactory;
         $model = $factory->buildResponse(array('type' => 'photo'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\PhotoResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory::buildResponse
     */
     public function testWillBuildVideoModelProperly()
     {
         $factory = new ResponseFactory;
         $model = $factory->buildResponse(array('type' => 'video'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\VideoResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory::buildResponse
     */
     public function testWillBuildRichModelProperly()
     {
         $factory = new ResponseFactory;
         $model = $factory->buildResponse(array('type' => 'rich'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\RichResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory::buildResponse
     */
     public function testWillBuildErrorModelProperly()
     {
         $factory = new ResponseFactory;
         $model = $factory->buildResponse(array('type' => 'error'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\ErrorResponse', get_class($model));
     }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactory::buildResponse
     */
     public function testWillBuildGenericModelWhenTypeIsUnknown()
     {
         $factory = new ResponseFactory;
         $model = $factory->buildResponse(array('type' => 'unknown'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\GenericResponse', get_class($model));
         $this->assertEquals('unknown', $model->getType());
     }
}