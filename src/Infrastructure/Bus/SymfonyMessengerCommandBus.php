<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\CQRS\CommandBus;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\MessageBusInterface;

final class SymfonyMessengerCommandBus implements CommandBus
{
    public function __construct(
        #[Autowire(service: 'messenger.bus.command')]
        private MessageBusInterface $messageBus,
    ) {
    }

    public function handle(object $command): mixed
    {
        return $this->messageBus->dispatch($command);
    }
}
