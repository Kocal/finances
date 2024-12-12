<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\Create;

use App\Domain\Data\Model\User;
use App\Domain\Data\Repository\UserRepository;
use App\Domain\Data\ValueObject\UserId;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

final readonly class Handler
{
    private PasswordHasherInterface $passwordHasher;

    public function __construct(
        PasswordHasherFactoryInterface $passwordHasherFactory,
        private UserRepository $userRepository,
    ) {
        $this->passwordHasher = $passwordHasherFactory->getPasswordHasher(User::class);
    }

    public function __invoke(Input $input): Output
    {
        $id = UserId::generate();

        $password = $this->passwordHasher->hash($input->plainPassword);

        $user = $input->admin
            ? User::createAdmin($id, $input->email, $password)
            : User::create($id, $input->email, $password);

        $this->userRepository->save($user);

        return new Output(
            user: $user
        );
    }
}
