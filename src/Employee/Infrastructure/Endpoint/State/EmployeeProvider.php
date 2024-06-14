<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Endpoint\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Employee\Application\Query\FindEmployee\FindEmployeeQuery;
use App\Employee\Domain\EmployeeView;
use App\Employee\Infrastructure\Endpoint\ApiResource\Employee;
use App\Shared\Application\Bus\QueryBus;

/**
 * @implements ProviderInterface<Employee>
 */
final readonly class EmployeeProvider implements ProviderInterface
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    #[\Override]
    /**
     * @param array{employeeID: int} $uriVariables
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?Employee
    {
        /* @phpstan-ignore-next-line */
        $employeeID = (int) $uriVariables['employeeID'];

        /** @var EmployeeView|null $result */
        $result = $this->queryBus->ask(new FindEmployeeQuery($employeeID));
        if (!$result) {
            return null;
        }

        return Employee::fromEmployeeView($result);
    }
}
