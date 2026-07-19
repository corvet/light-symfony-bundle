<?php

declare(strict_types=1);

use Corvet\LightSymfonyBundle\Controller\AdminEntityController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('Corvet\\LightSymfonyBundle\\', '../src/*')
        ->exclude([
            '../src/CorvetLightSymfonyBundle.php',
            '../src/DependencyInjection/',
        ]);

    $services
        ->set(AdminEntityController::class)
            // ->args([
            //     service('twig'),
            //     service('doctrine'),
            //     service('profiler'),
            // ])
            // ->tag('controller.service_arguments')
            ;
};
