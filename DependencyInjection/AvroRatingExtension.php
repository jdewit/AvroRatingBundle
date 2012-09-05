<?php
namespace Avro\RatingBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;

class AvroRatingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $config = $processor->processConfiguration($configuration, $configs);

        $loader->load(sprintf('%s.xml', $config['db_driver']));
        $loader->load('twig.xml');

        $container->setParameter('avro_rating.template', $config['template']);
        $container->setParameter('avro_rating.star_count', $config['star_count']);
        $container->setParameter('avro_rating.min_role', $config['min_role']);

    }
}

