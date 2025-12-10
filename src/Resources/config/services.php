<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Hl\LogReaderBundle\Service\LogfileService;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->public(false);

    $services->set('holsterlabs_log_reader.log_file_service', LogfileService::class)
        ->arg('$parameterBag', service('parameter_bag'));

    $services->alias(LogfileService::class, 'holsterlabs_log_reader.log_file_service');
};
