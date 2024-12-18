<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Transactions\ImportDump;

use Symfony\Component\Validator\Constraints as Assert;

final class Payload
{
    #[Assert\NotBlank]
    public string $csrfToken;
}
