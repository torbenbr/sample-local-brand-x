<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Endpoint\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Employee\Application\Command\DeletingEmployee\DeletingEmployeeCommand;
use App\Employee\Infrastructure\Endpoint\ApiResource\Employee;
use App\Shared\Application\Bus\CommandBus;

/**
 * @implements ProcessorInterface<Employee, null>
 */
final readonly class DeleteEmployeeProcessor implements ProcessorInterface
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    #[\Override]
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): null
    {
        /* @phpstan-ignore-next-line */
        $employeeID = (int) $uriVariables['employeeID'];
        $this->commandBus->execute(new DeletingEmployeeCommand($employeeID));

        return null;
    }
}
