<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

enum BankId: string implements Id
{
    case LA_BANQUE_POSTALE = 'LA_BANQUE_POSTALE';
    case BNP_PARIBAS = 'BNP_PARIBAS';
    case CREDIT_AGRICOLE = 'CREDIT_AGRICOLE';
    case SOCIETE_GENERALE = 'SOCIETE_GENERALE';
    case CIC = 'CIC';
    case CREDIT_MUTUEL = 'CREDIT_MUTUEL';
    case BANQUE_POPULAIRE = 'BANQUE_POPULAIRE';
    case CAISSE_EPARGNE = 'CAISSE_EPARGNE';
    case CREDIT_FONCIER = 'CREDIT_FONCIER';

    public static function fromString(string $id): static
    {
        return self::from($id);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(BankId $id): bool
    {
        return $this->value === $id->value;
    }
}
