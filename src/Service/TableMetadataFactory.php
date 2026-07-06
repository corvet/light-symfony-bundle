<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use Corvet\LightSymfonyBundle\Attribute\LightColumn;

class TableMetadataFactory
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function getColumnsMetadata(string $entityClass): array
    {
        $reflection = new ReflectionClass($entityClass);
        $doctrineMetadata = $this->em->getClassMetadata($entityClass);
        $columns = [];

        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();

            // 1. Отримуємо атрибут, якщо він є
            $attributeRef = $property->getAttributes(LightColumn::class)[0] ?? null;
            /** @var LightColumn|null $lightColumn */
            $lightColumn = $attributeRef ? $attributeRef->newInstance() : null;

            // 2. Визначаємо назву (заголовок)
            $title = $lightColumn?->title ?? ucfirst($propertyName);

            // 3. Визначаємо тип (Атрибут -> Doctrine -> Нативний PHP тип)
            $type = $lightColumn?->type;
            if (!$type) {
                if ($doctrineMetadata->hasField($propertyName)) {
                    $type = $doctrineMetadata->getTypeOfField($propertyName); // e.g. 'datetime_immutable', 'float'
                } elseif ($doctrineMetadata->hasAssociation($propertyName)) {
                    $type = 'association';
                } else {
                    $type = $property->getType()?->getName() ?? 'string';
                }
            }

            // Трансформуємо типи Doctrine/PHP у ваші внутрішні "Light" типи
            $type = $this->normalizeType($type);

            $columns[$propertyName] = [
                'title' => $title,
                'type' => $type,
                'sortable' => $lightColumn?->sortable ?? false,
                'options' => $lightColumn?->options ?? [],
            ];
        }

        return $columns;
    }

    private function normalizeType(string $type): string
    {
        return match($type) {
            'datetime', 'datetime_immutable', 'date' => 'date',
            'integer', 'smallint', 'bigint' => 'integer',
            'decimal', 'float' => 'float',
            'association' => 'link',
            default => 'string',
        };
    }
}
