<?php

/*
 * This file is part of the FOSFacebookBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nodrew\Bundle\EmbedlyBundle\Tests\DependencyInjection;

use Nodrew\Bundle\EmbedlyBundle\DependencyInjection\NodrewEmbedlyExtension;

class NodrewEmbedlyExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\DependencyInjection\NodrewEmbedlyExtension::load
     */
    public function testLoadFailure()
    {
        $container = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $extension = $this->getMockBuilder('Nodrew\Bundle\EmbedlyBundle\DependencyInjection\NodrewEmbedlyExtension')
            ->getMock();

        $extension->load(array(array()), $container);
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\DependencyInjection\NodrewEmbedlyExtension:load
     */
    public function testWillLoadWithOnlyKey()
    {
        $container = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $parameterBag = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ParameterBag\\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        $parameterBag
            ->expects($this->any())
            ->method('add');

        $container
            ->expects($this->any())
            ->method('getParameterBag')
            ->will($this->returnValue($parameterBag));

        $configs = array(
            array('key' => 'asdasd'),
        );
        $extension = new NodrewEmbedlyExtension();
        $extension->load($configs, $container);
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\DependencyInjection\NodrewEmbedlyExtension:load
     */
    public function testWillExplodeWithoutKey()
    {
        $this->setExpectedException('Symfony\\Component\\Config\\Definition\\Exception\\InvalidConfigurationException');

        $container = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $parameterBag = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ParameterBag\\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();
        
        
        $configs = array();
        $extension = new NodrewEmbedlyExtension();
        $extension->load($configs, $container);
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\DependencyInjection\NodrewEmbedlyExtension::load
     */
    public function testThatCanSetContainerAlias()
    {
        $container = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $parameterBag = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ParameterBag\\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        $parameterBag
            ->expects($this->any())
            ->method('add');

        $container
            ->expects($this->any())
            ->method('getParameterBag')
            ->will($this->returnValue($parameterBag));

        $configs = array(
            array('key' => 'wah'),
            array('timeout' => '3'),
            array('options' => array(
                'width'      => null,
                'maxwidth'   => null,
                'maxheight'  => null,
                'wmode'      => 'opaque',
                'nostyle'    => null,
                'autoplay'   => null,
                'videosrc'   => null,
                'words'      => 50,
                'chars'      => null,
            )),
        );
        $extension = new NodrewEmbedlyExtension();
        $extension->load($configs, $container);
    }
}
