<?php

namespace Dynamophp\HashBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const DEFAULT_START_SELECTION = 3;
    public const DEFAULT_END_SELECTION = 0;

    public static function getStartSelection(array $configuration): int
    {
        return $configuration['start_selection'] ?? self::DEFAULT_START_SELECTION;
    }

    public static function getEndSelection(array $configuration): int
    {
        return $configuration['end_selection'] ?? self::DEFAULT_END_SELECTION;
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dynamo_php_hash');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('start_selection')->defaultNull()->end()
                ->scalarNode('end_selection')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
