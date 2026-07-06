<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Environment;
use Corvet\LightSymfonyBundle\Model\LightTable;

class LightTableExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('light_table', [$this, 'renderTable'], ['is_safe' => ['html'], 'needs_environment' => true]),
        ];
    }

    public function renderTable(Environment $twig, LightTable $table): string
    {
        return $twig->render('@CorvetLightSymfony/table.html.twig', [
            'table' => $table,
        ]);
    }
}
