<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Create;

use App\Domain\Data\Model\Bank;
use Symfony\Component\Validator\Constraints as Assert;

final class FormModel
{
    #[Assert\NotBlank]
    public Bank $bank;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $label;
}
