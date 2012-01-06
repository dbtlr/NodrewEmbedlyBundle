<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Factory;

use Nodrew\Bundle\EmbedlyBundle\Factory\PreviewFactory;

class PreviewFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Factory\PreviewFactory::buildResponse
     */
     public function testWillBuildPreviewModelProperly()
     {
         $factory = new PreviewFactory;
         $model = $factory->buildResponse(array('type' => 'html'));

         $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\PreviewResponse', get_class($model));
     }
}