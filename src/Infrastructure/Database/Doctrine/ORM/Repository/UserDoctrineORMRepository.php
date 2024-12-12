<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\ORM\Repository;

use App\Domain\Data\Model\User;
use App\Domain\Data\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
final class UserDoctrineORMRepository extends ServiceEntityRepository implements UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOneByUserIdentifier(string $userIdentifier): ?User
    {
        return $this->findOneBy([
            'username' => $userIdentifier,
        ]);
    }

    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
    }
}
