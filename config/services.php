<?php

declare(strict_types=1);

namespace ApiClient;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container
        ->services()
        ->defaults()
            ->autoconfigure(true)
            ->autowire(true)
    ;
    $services
        ->load(__NAMESPACE__ . '\\', '../src/*')
        ->exclude(['../src/DependencyInjection'])
    ;
};
