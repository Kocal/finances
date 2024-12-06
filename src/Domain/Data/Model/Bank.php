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

    #[ORM\Column(type: 'string', unique: true)]
    private string $name;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->id = BankId::generate();
    }

    public static function create(string $name): self
    {
        $bank = new self();
        $bank->name = $name;
        $bank->createdAt = now();
        $bank->updatedAt = $bank->createdAt;

        return $bank;
    }

    public function getId(): BankId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
