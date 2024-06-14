<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Endpoint\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Employee\Application\Query\FindAllEmployees\FindAllEmployeesQuery;
use App\Employee\Domain\EmployeeView;
use App\Employee\Infrastructure\Endpoint\ApiResource\Employee;
use App\Shared\Application\Bus\QueryBus;
use Symfony\Component\HttpFoundation\Request;

/**
 * @implements ProviderInterface<Employee>
 */
final readonly class EmployeesProvider implements ProviderInterface
{
    private const int LIMIT = 20;

    public function __construct(private QueryBus $queryBus)
    {
    }

    /**
     * @return list<Employee>
     */
    #[\Override]
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var Request $request */
        $request = $context['request'];
        $page = $request->query->getInt('page', 1);

        /** @var list<EmployeeView> $results */
        $results = $this->queryBus->ask(new FindAllEmployeesQuery(
            self::LIMIT,
            ($page - 1) * self::LIMIT
        ));

        $employees = [];
        foreach ($results as $result) {
            $employees[] = Employee::fromEmployeeView($result);
        }

        return $employees;
    }
}
