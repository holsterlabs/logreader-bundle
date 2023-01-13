<?php

namespace H_\LogReaderBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class H_LogReaderExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        $loader = new XmlFileLoader(
            $containerBuilder,
            new FileLocator(
                __DIR__ . '/../Resources/config'
            )
        );
        $loader->load('services.xml');
    }
}