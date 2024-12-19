<?php

declare(strict_types=1);

namespace App\Application\Security\Voter;

use App\Domain\Data\Model\User;
use App\Domain\Data\Repository\BankAccountRepository;
use App\Domain\Data\ValueObject\BankAccountId;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @extends Voter<self::ATTRIBUTE, BankAccountId>
 */
final class CanAccessBankAccountVoter extends Voter
{
    public const ATTRIBUTE = 'can_access_bank_account';

    public function __construct(
        private readonly BankAccountRepository $bankAccountRepository
    ) {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute === self::ATTRIBUTE;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (! $user instanceof User) {
            return false;
        }

        return $this->bankAccountRepository->isOwnedByUser($subject, $user->getId());
    }
}
