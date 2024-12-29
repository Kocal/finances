<?php

declare(strict_types=1);

namespace App\Tests\Func\Domain\UseCase\BankAccounts\Transactions\List;

use App\Application\Model\Factory\BankAccountFactory;
use App\Application\Model\Factory\BankTransactionFactory;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use App\Domain\UseCase;
use App\Tests\Func\FunctionalTestCase;
use Money\Money;
use function Zenstruck\Foundry\Persistence\unproxy;

final class HandlerTest extends FunctionalTestCase
{
    public function testWhenThereAreNoTransactions(): void
    {
        $bankAccount = BankAccountFactory::createOne();

        $output = $this->handleQuery(new UseCase\BankAccounts\Transactions\List\Input(
            $bankAccount->getId(),
            '2024',
            '12',
        ));

        self::assertEmpty($output->transactions);
        self::assertNull($output->totalAmount);
        self::assertEmpty($output->amountByType);
        self::assertEmpty($output->amountByCategory);
    }

    public function testWhenThereAreTransactions(): void
    {
        self::mockTime(new \DateTimeImmutable('2024-12-01 00:00:00'));

        $bankAccount = unproxy(BankAccountFactory::createOne());
        $transactions = unproxy(BankTransactionFactory::createSequence([
            [
                'bankAccountId' => $bankAccount->getId(),
                'amount' => Money::EUR(-1_00),
                'date' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                'type' => Type::Pleasure,
                'category' => Category::TransportTrainTicket,
            ],
            [
                'bankAccountId' => $bankAccount->getId(),
                'amount' => Money::EUR(-50_00),
                'date' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                'type' => Type::Pleasure,
                'category' => Category::LeisureRestaurant,
            ],
            [
                'bankAccountId' => $bankAccount->getId(),
                'amount' => Money::EUR(-150_00),
                'date' => new \DateTimeImmutable('2024-12-10 00:00:00'),
                'type' => Type::Essential,
                'category' => Category::BankLoanRepayment,
            ],
            [
                'bankAccountId' => $bankAccount->getId(),
                'amount' => Money::EUR(-44_11),
                'date' => new \DateTimeImmutable('2024-12-21 00:00:00'),
                'type' => Type::Essential,
                'category' => Category::BankLoanRepayment,
            ],
            [
                'bankAccountId' => $bankAccount->getId(),
                // Not an expense, should be ignored
                'amount' => Money::EUR(10_00),
                'date' => new \DateTimeImmutable('2024-12-01 00:00:00'),
            ],
            [
                // Different bank account, should be ignored
                'bankAccountId' => BankAccountId::generate(),
                'amount' => Money::EUR(-500_00),
                'date' => new \DateTimeImmutable('2024-12-01 00:00:00'),
            ],
        ]));

        /** @var UseCase\BankAccounts\Transactions\List\Output $output */
        $output = $this->handleQuery(new UseCase\BankAccounts\Transactions\List\Input(
            $bankAccount->getId(),
            '2024',
            '12',
        ));

        self::assertEquals([
            $transactions[3],
            $transactions[2],
            $transactions[0],
            $transactions[1],
            $transactions[4],
        ], $output->transactions);
        self::assertEquals(Money::EUR(-245_11), $output->totalAmount);
        self::assertEquals([
            Type::Pleasure->value => Money::EUR(-51_00),
            Type::Essential->value => Money::EUR(-194_11),
        ], $output->amountByType);
        self::assertEquals([
            Category::Transport->value => Money::EUR(-1_00),
            Category::Leisure->value => Money::EUR(-50_00),
            Category::Bank->value => Money::EUR(-194_11),
        ], $output->amountByCategory, 'Amount should be merged and categorized by the main category.');
    }
}
