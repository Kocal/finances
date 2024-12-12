<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Application\CQRS\CommandBus;
use App\Domain\Data\ValueObject\Email;
use App\Domain\UseCase\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:user:create',
    description: 'Create a new user'
)]
final class UserCreateCommand extends Command
{
    private SymfonyStyle $io;

    public function __construct(
        private CommandBus $commandBus,
    ) {
        parent::__construct();
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io->title('Create a new user');

        $email = $this->io->ask('Email');
        $plainPassword = $this->io->askHidden('Password');
        $admin = $this->io->confirm('Is admin?', false);

        $this->commandBus->handle(new User\Create\Input(
            email: new Email($email),
            plainPassword: $plainPassword,
            admin: $admin
        ));

        $this->io->success('User created successfully!');

        return Command::SUCCESS;
    }
}
