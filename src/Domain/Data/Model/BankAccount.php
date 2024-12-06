<?php
declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;

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

    public function __construct()
    {
        $this->id = BankAccountId::generate();
    }

    public static function create(UserId $userId): self
    {
        $bankAccount = new self();
        $bankAccount->userId = $userId;

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
