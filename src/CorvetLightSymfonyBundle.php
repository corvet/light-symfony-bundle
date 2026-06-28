<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle;

use Corvet\LightSymfonyBundle\DependencyInjection\CorvetLightSymfonyExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CorvetLightSymfonyBundle extends Bundle
{
    protected function getContainerExtensionClass(): string
    {
        return CorvetLightSymfonyExtension::class;
    }
}
