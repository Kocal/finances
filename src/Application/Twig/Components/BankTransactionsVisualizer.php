<?php

declare(strict_types=1);

namespace App\Application\Twig\Components;

use App\Application\CQRS\QueryBus;
use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\UseCase\BankAccounts;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use function Symfony\Component\Clock\now;

#[AsLiveComponent]
final class BankTransactionsVisualizer
{
    use DefaultActionTrait;

    #[LiveProp]
    public BankAccountId $bankAccountId;

    #[LiveProp(writable: true, format: 'Y-m', url: true)]
    public \DateTimeImmutable $currentMonth;

    public function __construct(
        private QueryBus $queryBus,
    ) {
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->currentMonth ??= now();
    }

    #[LiveAction]
    public function prevMonth(): void
    {
        $this->currentMonth = $this->currentMonth->modify('first day of last month');
    }

    #[LiveAction]
    public function nextMonth(): void
    {
        $this->currentMonth = $this->currentMonth->modify('first day of next month');
    }

    /**
     * @return array<BankTransaction>
     */
    public function transactions(): array
    {
        /** @var BankAccounts\Transactions\List\Output $output */
        $output = $this->queryBus->handle(new BankAccounts\Transactions\List\Input(
            bankAccountId: $this->bankAccountId,
            year: $this->currentMonth->format('Y'),
            month: $this->currentMonth->format('m'),
        ));

        return $output->transactions;
    }
}
