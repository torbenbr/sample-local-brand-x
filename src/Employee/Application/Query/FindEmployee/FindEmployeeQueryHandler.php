<?php

declare(strict_types=1);

namespace App\Employee\Application\Query\FindEmployee;

use App\Employee\Domain\EmployeeRepository;
use App\Employee\Domain\EmployeeView;

final readonly class FindEmployeeQueryHandler
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
    }

    public function __invoke(FindEmployeeQuery $query): ?EmployeeView
    {
        $employee = $this->employeeRepository->findOneByEmployeeID($query->employeeID);

        if (!$employee) {
            return null;
        }

        return EmployeeView::fromEmployee($employee);
    }
}
