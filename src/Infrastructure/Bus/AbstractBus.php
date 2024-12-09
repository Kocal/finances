<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractBus
{
    use HandleTrait {
        handle as handleMessage;
    }

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * It is meant to be used synchronously.
     *
     * Symfony messenger exceptions are unwrapped to let client code catch what it likes.
     *
     * Dispatches the given message, expecting to be handled by a single handler
     * and returns the result from the handler returned value.
     *
     * This behavior is useful for both synchronous command & query buses,
     * the last one usually returning the handler result.
     *
     * @param object|Envelope $message The message or the message pre-wrapped in an envelope
     *
     * @return mixed The handler returned value
     */
    public function handle(object $message): mixed
    {
        try {
            return $this->handleMessage($message);
        } catch (HandlerFailedException $e) {
            $nested = $e->getWrappedExceptions();

            if (\count($nested) > 1) {
                throw new \LogicException('Bus cannot manage more than one nested exception from Symfony Messenger', 0, $e);
            }

            throw current($nested); // @phpstan-ignore-line - Invalid type Throwable|false to throw.
        }
    }

    /**
     * It is meant to be used asynchronously or synchronously with multiple handler.
     *
     * It does not unwrap exception throw by handler
     *
     * It dispatches in a Symfony Messenger bus.
     *
     * @param object|Envelope $message The message or the message pre-wrapped in an envelope
     */
    public function dispatch(object $message): void
    {
        $this->messageBus->dispatch($message);
    }
}
