<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController
{
    #[Route('/corvet/example', name: 'corvet_example')]
    public function index(): Response
    {
        return new Response('Привіт! Це мій найпростіший контролер Symfony.');
    }
}
