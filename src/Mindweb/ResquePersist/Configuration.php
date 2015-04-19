<?php
namespace Mindweb\ResquePersist;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('resque_persist');

        $rootNode->children()
            ->scalarNode('host')
                ->defaultValue('localhost')
            ->end()
            ->scalarNode('port')
                ->defaultValue('6379')
            ->end()
            ->scalarNode('queue')
                ->defaultValue('preAnalytics')
            ->end()
            ->scalarNode('job')
                ->defaultValue('Analyze')
            ->end()
        ->end();

        return $treeBuilder;
    }
}