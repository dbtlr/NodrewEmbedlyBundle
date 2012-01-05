<?php

namespace Nodrew\Bundle\EmbedlyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * @package     NodrewEmbedlyBundle
 * @author      Drew Butler <drew@abstracting.me>
 * @copyright	(c) 2012 Drew Butler
 * @license     http://www.opensource.org/licenses/mit-license.php
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nodrew_embedly', 'array');

        $rootNode
            ->children()
                ->scalarNode('key')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('timeout')->cannotBeEmpty()->end()
                ->arrayNode('options')
                    ->children()
                        ->scalarNode('width')->end()
                        ->scalarNode('maxwidth')->end()
                        ->scalarNode('maxheight')->end()
                        ->scalarNode('wmode')->end()
                        ->scalarNode('nostyle')->end()
                        ->scalarNode('autoplay')->end()
                        ->scalarNode('videosrc')->end()
                        ->scalarNode('words')->end()
                        ->scalarNode('chars')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder->buildTree();
    }
}
