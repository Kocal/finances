<?php
declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankId;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use function Symfony\Component\Clock\now;

#[ORM\Entity]
#[ORM\Table(name: 'bank')]
class Bank
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'bank_id')]
    private BankId $id;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    private function __construct(BankId $id)
    {
        $this->id = $id;
    }

    public static function create(BankId $id): self
    {
        $bank = new self($id);
        $bank->createdAt = now();
        $bank->updatedAt = $bank->createdAt;

        return $bank;
    }

    public function getId(): BankId
    {
        return $this->id;
    }
}
