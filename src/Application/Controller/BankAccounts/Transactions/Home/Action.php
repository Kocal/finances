<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Transactions\Home;

use App\Application\Security\Voter\CanAccessBankAccountVoter;
use App\Domain\Data\Model\User;
use App\Domain\Data\ValueObject\BankAccountId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/bank-accounts/{bankAccountId}/transactions', name: 'app_bank_accounts_transactions_home', methods: ['GET'])]
#[IsGranted('ROLE_USER')]
#[IsGranted(CanAccessBankAccountVoter::ATTRIBUTE, subject: 'bankAccountId')]
final class Action extends AbstractController
{
    public function __invoke(
        #[CurrentUser]
        User $user,
        BankAccountId $bankAccountId
    ): Response {
        return $this->render('pages/bank_accounts/transactions/home.html.twig', [
            'bankAccountId' => $bankAccountId,
        ]);
    }
}
