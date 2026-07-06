<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Attribute;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class LightColumn {
    public function __construct(
        public ?string $title = null,
        public ?string $type = null, // string, date, link, float тощо
        public bool $sortable = false,
        public array $options = [] // Для кастомних штук на кшталт currency, format
    ) {}
}
