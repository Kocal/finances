<?php

declare(strict_types=1);

namespace App\Application\Twig\Components;

use App\Application\CQRS\QueryBus;
use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use App\Domain\UseCase\BankAccounts;
use Money\Money;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use function Symfony\Component\Clock\now;

#[AsLiveComponent]
final class BankTransactionsVisualizer
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp]
    public BankAccountId $bankAccountId;

    #[LiveProp(writable: true, format: 'Y-m', url: true)]
    public \DateTimeImmutable $currentMonth;

    /**
     * @var array<BankTransaction>
     */
    public array $transactions;

    public ?Money $totalAmount;

    /**
     * @var array<value-of<Type>, Money>
     */
    public array $amountByType;

    /**
     * @var array<value-of<Category>, Money>
     */
    public array $amountByCategory;

    public function __construct(
        private QueryBus $queryBus,
    ) {
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->currentMonth ??= now();
        $this->updateInternalState();
    }

    #[LiveAction]
    public function prevMonth(): void
    {
        $this->currentMonth = $this->currentMonth->modify('first day of last month');
        $this->updateInternalState();
    }

    #[LiveAction]
    public function nextMonth(): void
    {
        $this->currentMonth = $this->currentMonth->modify('first day of next month');
        $this->updateInternalState();
    }

    private function updateInternalState(): void
    {
        /** @var BankAccounts\Transactions\List\Output $output */
        $output = $this->queryBus->handle(new BankAccounts\Transactions\List\Input(
            bankAccountId: $this->bankAccountId,
            year: $this->currentMonth->format('Y'),
            month: $this->currentMonth->format('m'),
        ));

        $this->transactions = $output->transactions;
        $this->totalAmount = $output->totalAmount;
        $this->amountByType = $output->amountByType;
        $this->amountByCategory = $output->amountByCategory;
    }
}
