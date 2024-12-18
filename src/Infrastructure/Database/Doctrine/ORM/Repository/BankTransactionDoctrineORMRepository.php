<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\ORM\Repository;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\Repository\BankTransactionRepository;
use App\Domain\Data\ValueObject\BankAccountId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
            'bankAccountId' => $bankAccountId,
        ]);
    }

    public function save(BankTransaction $bankTransaction): void
    {
        $this->getEntityManager()->persist($bankTransaction);
    }

    public function hasEquivalent(BankTransaction $bankTransaction): bool
    {
        $qb = $this->createQueryBuilder('bt')
            ->select('COUNT(bt.id)')
            ->where('bt.bankAccountId = :bankAccountId')
            ->andWhere("JSON_GET_TEXT(bt.amount, 'amount') = :amount")
            ->andWhere("JSON_GET_TEXT(bt.amount, 'currency') = :currency")
            ->andWhere('bt.date = :date')
            ->andWhere('bt.label = :label')
            ->setParameter('bankAccountId', $bankTransaction->getBankAccountId())
            ->setParameter('amount', $bankTransaction->getAmount()->getAmount())
            ->setParameter('currency', $bankTransaction->getAmount()->getCurrency()->getCode())
            ->setParameter('date', $bankTransaction->getDate())
            ->setParameter('label', $bankTransaction->getLabel());

        return (int) $qb->getQuery()->getSingleScalarResult() > 0;
    }
}
