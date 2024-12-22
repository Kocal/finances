<?php

declare(strict_types=1);

namespace App\Application\Controller\Styleguide;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/styleguide', name: 'app_styleguide', methods: ['GET'], condition: '%kernel.debug%')]
#[IsGranted('ROLE_USER')]
final class HomeController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('pages/styleguide/home.html.twig');
    }
}
