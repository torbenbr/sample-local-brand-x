<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Application\Bus;

use App\Shared\Application\Bus\Command;
use App\Shared\Infrastructure\Application\Bus\Messenger\MessengerCommandBus;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBusTest extends TestCase
{
    public function testExecuteCommand(): void
    {
        $messengerBus = $this->createMock(MessageBusInterface::class);
        $messengerCommandBus = new MessengerCommandBus($messengerBus);

        $command = new class() implements Command {};

        $messengerBus->expects($this->once())
            ->method('dispatch')
            ->willReturn(new Envelope($command))
        ;

        $messengerCommandBus->execute($command);
    }

    public function testExecuteCommandFailed(): void
    {
        $this->expectException(\DomainException::class);

        $messengerBus = $this->createStub(MessageBusInterface::class);
        $messengerCommandBus = new MessengerCommandBus($messengerBus);

        $command = new class() implements Command {};

        $messengerBus->method('dispatch')
            ->willThrowException(new HandlerFailedException(
                new Envelope($command),
                [new \DomainException()]
            ))
        ;

        $messengerCommandBus->execute($command);
    }
}
