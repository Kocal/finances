<?php

declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankId;
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

    #[ORM\Column(type: 'bank_id')]
    private BankId $bankId;

    #[ORM\Column(type: 'string')]
    private string $label;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    private function __construct(BankAccountId $id)
    {
        $this->id = $id;
    }

    public static function create(BankAccountId $id, UserId $userId, BankId $bankId, string $label): self
    {
        $bankAccount = new self($id);
        $bankAccount->userId = $userId;
        $bankAccount->bankId = $bankId;
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

    public function getBankId(): BankId
    {
        return $this->bankId;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
