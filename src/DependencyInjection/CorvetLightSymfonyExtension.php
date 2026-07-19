<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class CorvetLightSymfonyExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.php');
    }

    public function prepend(ContainerBuilder $container): void
    {
        if ($container->hasExtension('framework')) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        dirname(__DIR__, 2) . '/assets' => '@corvet/light-symfony-bundle',
                    ],
                ],
                'router' => [
                    'resource' => dirname(__DIR__) . '/Controller/', // Шлях до папки з контролерами
                    'type' => 'attribute',
                ],
            ]);
        }

        if ($container->hasExtension('twig')) {
            $container->prependExtensionConfig('twig', [
                'paths' => [
                    dirname(__DIR__, 2) . '/templates' => 'CorvetLightSymfonyBundle',
                ],
                'form_themes' => [
                    '@CorvetLightSymfonyBundle/form_theme.html.twig',
                ],
            ]);
        }
    }

    public function getAlias(): string
    {
        return 'corvet_light_symfony';
    }
}
