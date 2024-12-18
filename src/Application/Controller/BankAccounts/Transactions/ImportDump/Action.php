<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Transactions\ImportDump;

use App\Application\CQRS\CommandBus;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use App\Domain\UseCase\BankAccounts\Transactions\ImportDump\Input;
use App\Domain\UseCase\BankAccounts\Transactions\ImportDump\Output;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/bank_accounts/{bankAccountId}/transactions/import', name: 'app_bank_accounts_transactions_import_dump', methods: ['POST'])]
#[IsGranted('ROLE_USER')]
final class Action extends AbstractController
{
    public function __construct(
        private CommandBus $commandBus,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(
        #[MapRequestPayload]
        Payload $payload,
        #[MapUploadedFile]
        UploadedFile $file,
        BankAccountId $bankAccountId,
    ): Response {
        if (! $this->isCsrfTokenValid('bank_transactions:import_dump', $payload->csrfToken)) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        try {
            /** @var Output $output */
            $output = $this->commandBus->handle(new Input(
                bankAccountId: $bankAccountId,
                dump: UserDump::fromUploadedFile($file),
            ));

            if ($output->imported === 0) {
                $this->addFlash('warning', 'No transactions have been imported.');
            } else {
                $this->addFlash('success', sprintf('The dump has been imported successfully, %d transactions imported, %d transactions skipped.', $output->imported, $output->skipped));
            }
        } catch (\Throwable $e) {
            $this->addFlash('error', 'An error occurred while importing the dump.');
            $this->logger->error('An error occurred while importing the dump.', [
                'exception' => $e,
                'bankAccountId' => $bankAccountId->toString(),
            ]);
        }

        return $this->redirectToRoute('app_bank_accounts_transactions_home', [
            'bankAccountId' => $bankAccountId->toString(),
        ]);
    }
}
