<?php
declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\BankId;
use Doctrine\ORM\Mapping as ORM;

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

    public function __construct()
    {
        $this->id = BankId::generate();
    }

    public static function create(string $name): self
    {
        $bank = new self();
        $bank->name = $name;

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
