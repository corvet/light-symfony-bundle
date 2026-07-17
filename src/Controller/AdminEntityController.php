<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Controller;

use Corvet\LightSymfonyBundle\Service\EntityRegistryExplorer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntityController extends AbstractController
{
    public const ACTION_SELECT = 'admin_entity_select';
    public const ACTION_INDEX = 'admin_entity_index';
    public const ACTION_SHOW = 'admin_entity_show';

    #[Route('/admin/entity/', name: self::ACTION_SELECT)]
    public function select(EntityRegistryExplorer $explorer): Response
    {
        return $this->render('@CorvetLightSymfony/admin/select.html.twig', [
            'entityTree' => $explorer->getSchemaMap(),
        ]);
    }

    #[Route('/admin/entity/{entity}/', name: self::ACTION_INDEX)]
    public function fallbackIndex(string $entity): Response
    {
        // $entity прийде як "App-Entity-Inventory-Nomenclature"
        $className = str_replace('-', '\\', $entity);

        // Тут ви використовуєте ваш LightTableFactory з попереднього питання!
        // Беруться всі записи з репозиторію цього класу і малюються в базову таблицю.
        return new Response("Автоматичний список для: " . $className);
    }

    #[Route('/admin/entity/{entity}/{id}', name: self::ACTION_SHOW, requirements: ['id' => '\d+'])]
    public function fallbackShow(string $entity, int $id): Response
    {
        $className = str_replace('-', '\\', $entity);
        return new Response("Автоматичний перегляд id={$id} для: " . $className);
    }
}
