<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Factory;

use Corvet\LightSymfonyBundle\Model\LightTable;
use Corvet\LightSymfonyBundle\Service\TableMetadataFactory;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class LightTableFactory
{
    public function __construct(
        private TableMetadataFactory $metadataFactory,
        private PropertyAccessorInterface $propertyAccessor // Компонент Symfony для динамічного читання getter-ів
    ) {}

    public function create(string $entityClass, iterable $collection, ?array $options = null): LightTable
    {
        $columnsMetadata = $this->metadataFactory->getColumnsMetadata($entityClass);

        $headers = [];
        foreach ($columnsMetadata as $field => $meta) {
            $headers[$field] = $meta['title'];
        }

        $rows = [];
        foreach ($collection as $entity) {
            $row = [];
            foreach ($columnsMetadata as $field => $meta) {
                // Динамічно беремо значення через геттер або property (напр. $entity->getNumber())
                $rawValue = $this->propertyAccessor->getValue($entity, $field);

                // Якщо це зв'язана сутність (наприклад Customer) без кастомного атрибуту,
                // намагаємось витягнути її назву, якщо вона має LightEntity, або через __toString()
                if ($meta['type'] === 'entity' && is_object($rawValue)) {
                    // Тут логіка для лінків...
                }

                $row[$field] = [
                    'value' => $rawValue,
                    'meta' => $meta
                ];
            }
            $rows[] = $row;
        }

        return new LightTable($headers, $rows);
    }
}
