<?php
declare(strict_types=1);

namespace App\Domain\Data\Model;

use App\Domain\Data\ValueObject\UserId;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use function Symfony\Component\Clock\now;

#[ORM\Entity]
#[ORM\Table(name: 'app_user')]
#[ORM\Index(columns: ['email'])]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'user_id')]
    private UserId $id;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private string $password;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;


    public static function create(string $email, string $password): self
    {
        $user = new self();
        $user->email = $email;
        $user->password = $password;
        $user->roles = ['ROLE_USER'];
        $user->createdAt = now();
        $user->updatedAt = $user->createdAt;

        return $user;
    }

    public static function createAdmin(string $email, string $password): self
    {
        $user = self::create($email, $password);
        $user->roles = ['ROLE_ADMIN'];

        return $user;
    }

    public function __construct()
    {
        $this->id = UserId::generate();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
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
