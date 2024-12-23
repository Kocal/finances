<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Home;

use App\Application\CQRS\QueryBus;
use App\Domain\Data\Model\User;
use App\Domain\UseCase\BankAccounts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/bank-accounts', name: 'app_bank_accounts_home', methods: ['GET'])]
#[IsGranted('ROLE_USER')]
final class Action extends AbstractController
{
    public function __construct(
        private QueryBus $queryBus,
    ) {
    }

    public function __invoke(#[CurrentUser] User $user): Response
    {
        /** @var BankAccounts\List\Output $output */
        $output = $this->queryBus->handle(new BankAccounts\List\Input(
            userId: $user->getId(),
        ));

        return $this->render('pages/bank_accounts/home.html.twig', [
            'bank_accounts' => $output->bankAccounts,
        ]);
    }
}
