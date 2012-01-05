<?php

namespace Nodrew\Bundle\EmbedlyBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class NodrewEmbedlyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $processor     = new Processor();
        $configuration = new Configuration();

        $config = $processor->process($configuration->getConfigTree(), $configs);
        $loader->load('services.xml');

        $this->setConfig($config, $container);
    }
    
    /**
     * Set the config options.
     *
     * @param array $config
     * @param Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    protected function setConfig($config, $container)
    {
        $container->setParameter('nodrew_embedly.key', $config['key']);
        
        if (isset($config['timeout'])) {
            $container->setParameter('nodrew_embedly.timeout', $config['timeout']);
        }
        
        if (isset($config['options'])) {
            $container->setParameter('nodrew_embedly.options', $config['options']);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return 'http://www.nodrew.com/schema/dic/embedly_bundle';
    }
}
