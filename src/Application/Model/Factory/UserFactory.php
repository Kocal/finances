<?php

declare(strict_types=1);

namespace App\Application\Model\Factory;

use App\Domain\Data\Model\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory
{
    private PasswordHasherInterface $passwordHasher;

    public function __construct(
        PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
        $this->passwordHasher = $passwordHasherFactory->getPasswordHasher(User::class);
    }

    public static function class(): string
    {
        return User::class;
    }

    public function admin(): self
    {
        return $this->with([
            '_admin' => true,
        ]);
    }

    protected function defaults(): array|callable
    {
        return [
            'username' => self::faker()->text(180),
            'plainPassword' => 'password',
            '_admin' => false,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            ->beforeInstantiate(function (array $attributes): array {
                if (! isset($attributes['password'])) {
                    $attributes['password'] = $this->passwordHasher->hash($attributes['plainPassword']);
                    unset($attributes['plainPassword']);
                }

                return $attributes;
            })
            ->instantiateWith(function (array $attributes) {
                $admin = $attributes['_admin'];
                unset($attributes['_admin']);

                if ($admin) {
                    return User::createAdmin(...$attributes);
                }

                return User::create(...$attributes);
            })
        ;
    }
}
