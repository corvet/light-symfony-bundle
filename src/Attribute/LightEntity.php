<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class LightEntity {
    public function __construct(
        public ?string $title = null,
        public ?string $routeIndex = null,
        public ?string $routeShow = null,
        public ?string $routeEdit = null,
        public ?string $routeNew = null,
        public ?string $routeDelete = null,
        public string $fieldId = 'id'
    ) {}
}
