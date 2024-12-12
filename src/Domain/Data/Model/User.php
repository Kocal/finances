<?php

declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\Email;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function Symfony\Component\Clock\now;

#[ORM\Entity]
#[ORM\Table(name: 'app_user')]
#[ORM\Index(columns: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'user_id')]
    private UserId $id;

    /**
     * @var non-empty-string
     */
    #[ORM\Column(type: 'email', length: Email::MAX_LENGTH, unique: true)]
    private Email $email;

    /*
     * @var string[]
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private string $password;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    private function __construct(UserId $id)
    {
        $this->id = $id;
    }

    /**
     * @param non-empty-string $email
     * @param non-empty-string $password
     */
    public static function create(UserId $id, Email $email, string $password): self
    {
        $user = new self($id);
        $user->email = $email;
        $user->password = $password;
        $user->roles = ['ROLE_USER'];
        $user->createdAt = now();
        $user->updatedAt = $user->createdAt;

        return $user;
    }

    /**
     * @param non-empty-string $email
     * @param non-empty-string $password
     */
    public static function createAdmin(UserId $id, Email $email, string $password): self
    {
        $user = self::create($id, $email, $password);
        $user->roles = ['ROLE_ADMIN'];

        return $user;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email->toString();
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function eraseCredentials(): void
    {

    }
}
