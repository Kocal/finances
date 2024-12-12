<?php

declare(strict_types=1);

namespace App\Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/', name: 'app_home')]
#[IsGranted('ROLE_USER')]
final readonly class HomeController
{
    public function __invoke(): Response
    {
        return new Response('Hello');
    }
}
