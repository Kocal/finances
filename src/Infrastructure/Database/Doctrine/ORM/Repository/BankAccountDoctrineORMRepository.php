<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\ORM\Repository;

use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\Repository\BankAccountRepository;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Exception\BankAccountNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BankAccount>
 */
final class BankAccountDoctrineORMRepository extends ServiceEntityRepository implements BankAccountRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankAccount::class);
    }

    public function get(BankAccountId $bankAccountId): BankAccount
    {
        return $this->find($bankAccountId) ?? throw BankAccountNotFoundException::byId($bankAccountId);
    }

    public function save(Bank $bank): void
    {
        $this->getEntityManager()->persist($bank);
    }
}
