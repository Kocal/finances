<?php
declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransactionId;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;
use Money\Money;

#[ORM\Entity]
#[ORM\Table(name: 'bank_transaction')]
class BankTransaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'bank_transaction_id')]
    private BankTransactionId $id;

    #[ORM\Column(type: 'bank_account_id')]
    private BankAccountId $bankAccountId;

    #[ORM\Column(type: 'money')]
    private Money $amount;

    public function __construct()
    {
        $this->id = BankTransactionId::generate();
    }

    public static function create(BankAccountId $bankAccountId, Money $amount): self
    {
        $bankAccount = new self();
        $bankAccount->bankAccountId = $bankAccountId;
        $bankAccount->amount = $amount;

        return $bankAccount;
    }

    public function getId(): BankTransactionId
    {
        return $this->id;
    }

    public function getBankAccountId(): BankAccountId
    {
        return $this->bankAccountId;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }
}
