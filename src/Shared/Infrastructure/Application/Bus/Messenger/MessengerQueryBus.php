<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Application\Bus\Messenger;

use App\Shared\Application\Bus\QueryBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final readonly class MessengerQueryBus implements QueryBus
{
    public function __construct(private MessageBusInterface $queryBus)
    {
    }

    #[\Override]
    public function ask(object $query): mixed
    {
        try {
            $envelope = $this->queryBus->dispatch($query);
            /** @var HandledStamp $handled */
            $handled = $envelope->last(HandledStamp::class);

            return $handled->getResult();
        } catch (HandlerFailedException $e) {
            /* @phpstan-ignore-next-line */
            throw $e->getPrevious();
        }
    }
}
