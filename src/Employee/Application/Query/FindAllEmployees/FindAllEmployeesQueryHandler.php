<?php

declare(strict_types=1);

namespace App\Employee\Application\Query\FindAllEmployees;

use App\Employee\Domain\EmployeeRepository;
use App\Employee\Domain\EmployeeView;

final readonly class FindAllEmployeesQueryHandler
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
    }

    /**
     * @return \Generator<EmployeeView>
     */
    public function __invoke(FindAllEmployeesQuery $query): \Generator
    {
        $employees = $this->employeeRepository->findAllWithLimitAndOffset(
            $query->limit,
            $query->offset,
        );

        foreach ($employees as $employee) {
            yield EmployeeView::fromEmployee($employee);
        }
    }
}
