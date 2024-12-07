<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\ORM\Repository;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\Repository\BankTransactionRepository;
use App\Domain\Data\ValueObject\BankAccountId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BankTransaction>
 */
final class BankTransactionDoctrineORMRepository extends ServiceEntityRepository implements BankTransactionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankTransaction::class);
    }

    public function findByBankAccount(BankAccountId $bankAccountId): array
    {
        return $this->findBy([
            'bankAccountId' => $bankAccountId
        ]);
    }

    public function save(BankTransaction $bankTransaction): void
    {
        $this->getEntityManager()->persist($bankTransaction);
    }
}
