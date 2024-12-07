<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\ORM\Repository;

use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\Repository\BankRepository;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Exception\BankNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class BankDoctrineORMRepository extends ServiceEntityRepository implements BankRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bank::class);
    }

    public function get(BankId $bankId): Bank
    {
        return $this->find($bankId) ?? throw BankNotFound::byId($bankId);
    }

    public function save(Bank $bank): void
    {
        $this->getEntityManager()->persist($bank);
    }
}
