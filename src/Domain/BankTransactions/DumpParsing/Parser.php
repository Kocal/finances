<?php
declare(strict_types=1);

namespace App\Domain\BankTransactions\DumpParsing;

use App\Domain\BankTransactions\DumpParsing\Strategy\Strategy;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\Repository\BankRepository;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class Parser
{
    public function __construct(

        /**
         * @param iterable<Strategy> $strategies
         */
        #[AutowireIterator(Strategy::class)]
        private iterable $strategies,
        private BankRepository $bankRepository,
    ) {
    }

    /**
     * @return iterable<BankTransaction>
     */
    public function parse(BankAccount $bankAccount, UserDump $dump): iterable
    {
        $bank = $this->bankRepository->get($bankAccount->getBankId());

        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($bank, $dump)) {
                $strategy->parse($bank, $dump);
            }
        }

        throw new \RuntimeException('No strategy found to parse the dump');
    }
}
