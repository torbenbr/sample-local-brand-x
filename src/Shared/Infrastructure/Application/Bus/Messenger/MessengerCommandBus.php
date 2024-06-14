<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Application\Bus\Messenger;

use App\Shared\Application\Bus\Command;
use App\Shared\Application\Bus\CommandBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class MessengerCommandBus implements CommandBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    /**
     * @throws \Throwable
     */
    #[\Override]
    public function execute(Command $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (HandlerFailedException $e) {
            /* @phpstan-ignore-next-line */
            throw $e->getPrevious();
        }
    }
}
