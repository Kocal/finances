<?php

declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use App\Domain\Data\ValueObject\BankTransactionId;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Money\Money;
use function Symfony\Component\Clock\now;

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

    #[ORM\Column(type: Types::STRING)]
    private string $label;

    #[ORM\Column(type: Types::STRING, enumType: Type::class)]
    private Type $type;

    #[ORM\Column(type: Types::STRING, enumType: Category::class)]
    private Category $category;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $date;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    private function __construct()
    {
        $this->id = BankTransactionId::generate();
    }

    public static function create(
        BankAccountId $bankAccountId,
        Money $amount,
        string $label,
        \DateTimeImmutable $date,
        Type $type = Type::Unknown,
        Category $category = Category::Unknown,
    ): self {
        $bankTransaction = new self();
        $bankTransaction->bankAccountId = $bankAccountId;
        $bankTransaction->amount = $amount;
        $bankTransaction->label = $label;
        $bankTransaction->date = $date;
        $bankTransaction->type = $type;
        $bankTransaction->category = $category;
        $bankTransaction->createdAt = now();
        $bankTransaction->updatedAt = $bankTransaction->createdAt;

        return $bankTransaction;
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

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
