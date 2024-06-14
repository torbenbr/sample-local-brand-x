<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus;

interface CommandBus
{
    public function execute(Command $command): void;
}
