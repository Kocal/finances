<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Create;

use App\Application\CQRS\CommandBus;
use App\Domain\Data\Model\User;
use App\Domain\UseCase\BankAccounts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/bank_accounts/create', name: 'app_bank_accounts_create', methods: ['GET', 'POST'])]
#[IsGranted('ROLE_USER')]
final class Action extends AbstractController
{
    public function __construct(
        private CommandBus $commandBus,
    ) {
    }

    public function __invoke(Request $request, #[CurrentUser] User $user): Response
    {
        $form = $this->createForm(FormType::class, $formModel = new FormModel());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var BankAccounts\Create\Output $output */
                $output = $this->commandBus->handle(new BankAccounts\Create\Input(
                    $formModel->bank->getId(),
                    $formModel->label,
                    $user->getId(),
                ));

                $this->addFlash('success', 'Bank account created successfully.');

                return $this->redirectToRoute('app_bank_accounts_home');
            } catch (\Throwable $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('pages/bank_accounts/create.html.twig', [
            'form' => $form,
        ]);
    }
}
