<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\MessageBusInterface;

final class NonTransactionalBus extends AbstractBus
{
    public function __construct(
        #[Autowire(service: 'messenger.bus.non_transactional')]
        MessageBusInterface $messageBus,
    ) {
        parent::__construct($messageBus);
    }
}
