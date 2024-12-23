<?php

declare(strict_types=1);

namespace App\Application\Controller\IncomeSplitter\Home;

use App\Domain\Data\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/income-splitter', name: 'app_income_splitter_home', methods: ['GET'])]
#[IsGranted('ROLE_USER')]
final class Action extends AbstractController
{
    public function __invoke(#[CurrentUser] User $user): Response
    {
        return $this->render('pages/income_splitter/home.html.twig');
    }
}
