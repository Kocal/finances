<?php
declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use function Symfony\Component\Clock\now;

#[ORM\Entity]
#[ORM\Table(name: 'bank_account')]
class BankAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'bank_account_id')]
    private BankAccountId $id;

    #[ORM\Column(type: 'user_id')]
    private UserId $userId;

    #[ORM\Column(type: 'string')]
    private string $label;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;


    private function __construct()
    {
        $this->id = BankAccountId::generate();
    }

    public static function create(UserId $userId, string $label): self
    {
        $bankAccount = new self();
        $bankAccount->userId = $userId;
        $bankAccount->label = $label;
        $bankAccount->createdAt = now();
        $bankAccount->updatedAt = $bankAccount->createdAt;

        return $bankAccount;
    }

    public function getId(): BankAccountId
    {
        return $this->id;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }
}
