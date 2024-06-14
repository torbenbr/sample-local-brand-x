<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Application\Bus;

use App\Shared\Infrastructure\Application\Bus\Messenger\MessengerQueryBus;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class MessengerQueryBusTest extends TestCase
{
    public function testExecuteQuery(): void
    {
        $messengerBus = $this->createMock(MessageBusInterface::class);
        $messengerQueryBus = new MessengerQueryBus($messengerBus);

        $query = new \stdClass();

        $messengerBus->expects($this->once())
            ->method('dispatch')
            ->willReturn((new Envelope($query))->with(new HandledStamp('foo', 'bar')))
        ;

        $result = $messengerQueryBus->ask($query);
        self::assertSame('foo', $result);
    }

    public function testExecuteQueryFailed(): void
    {
        $this->expectException(\DomainException::class);

        $messengerBus = $this->createStub(MessageBusInterface::class);
        $messengerQueryBus = new MessengerQueryBus($messengerBus);

        $query = new \stdClass();

        $messengerBus->method('dispatch')
            ->willThrowException(new HandlerFailedException(
                new Envelope($query),
                [new \DomainException()]
            ))
        ;

        $messengerQueryBus->ask($query);
    }
}
