<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class LightEntity {
    public function __construct(
        public ?string $title = null,
        public ?string $route = null,
        public string $parameter = 'id'
    ) {}
}
