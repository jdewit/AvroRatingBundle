<?php

namespace Avro\RatingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('avro_rating');

        $rootNode
            ->children()
                ->scalarNode('db_driver')->defaultValue('mongodb')->cannotBeEmpty()->end()
                ->scalarNode('template')->defaultValue('AvroRatingBundle:Rating:rating.html.twig')->cannotBeEmpty()->end()
                ->scalarNode('star_count')->defaultValue(5)->cannotBeEmpty()->end()
                ->scalarNode('min_role')->defaultValue("ROLE_USER")->cannotBeEmpty()->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
