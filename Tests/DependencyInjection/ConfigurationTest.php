<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Nodrew\Bundle\EmbedlyBundle\DependencyInjection\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\DependencyInjection\Configuration::getConfigTree
     */
    public function testThatCanGetConfigTree()
    {
        $configuration = new Configuration();
        $this->assertInstanceOf('Symfony\Component\Config\Definition\NodeInterface', $configuration->getConfigTree());
    }
}