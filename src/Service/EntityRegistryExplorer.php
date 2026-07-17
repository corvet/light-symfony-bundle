<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Corvet\LightSymfonyBundle\Attribute\LightEntity;

class EntityRegistryExplorer
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function getSchemaMap(): array
    {
        $allMetadata = $this->em->getMetadataFactory()->getAllMetadata();
        $tree = [];

        foreach ($allMetadata as $meta) {
            $className = $meta->getName(); // Напр: "App\Entity\Inventory\Invoice"

            if (!str_starts_with($className, 'App\\Entity\\')) {
                continue;
            }

            // Витягуємо суб-категорію (напр. "Inventory") та коротку назву (напр. "Invoice")
            $relativeSpace = str_replace('App\\Entity\\', '', $className);
            $parts = explode('\\', $relativeSpace);

            $classNameShort = array_pop($parts); // "Invoice"
            $groupName = !empty($parts) ? implode('\\', $parts) : 'General'; // "Inventory"

            // Безпечний ідентифікатор для URL (App-Entity-Inventory-Invoice)
            $urlSafeSlug = str_replace('\\', '-', $className);

            // Читаємо атрибут через Reflection
            $reflection = new \ReflectionClass($className);
            $attributeRef = $reflection->getAttributes(LightEntity::class)[0] ?? null;

            /** @var LightEntity|null $lightAttr */
            $lightAttr = $attributeRef ? $attributeRef->newInstance() : null;

            // Формуємо маркер "наявності" власних методів (I S E N D)
            $isend = [];
            if ($lightAttr?->routeIndex)  $isend[] = 'I';
            if ($lightAttr?->routeShow)   $isend[] = 'S';
            if ($lightAttr?->routeEdit)   $isend[] = 'E';
            if ($lightAttr?->routeNew)    $isend[] = 'N';
            if ($lightAttr?->routeDelete) $isend[] = 'D';

            $tree[$groupName][] = [
                'shortName'   => $classNameShort,
                'fullName'    => $className,
                'slug'        => $urlSafeSlug,
                'title'       => $lightAttr?->title,
                'customIndex' => $lightAttr?->routeIndex,
                'isend'       => $isend,
                'hasCustom'   => $lightAttr !== null
            ];
        }

        ksort($tree);
        return $tree;
    }
}
