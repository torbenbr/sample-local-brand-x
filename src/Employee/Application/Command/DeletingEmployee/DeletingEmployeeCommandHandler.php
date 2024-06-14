<?php

declare(strict_types=1);

namespace App\Employee\Application\Command\DeletingEmployee;

use App\Employee\Domain\EmployeeRepository;

final readonly class DeletingEmployeeCommandHandler
{
    public function __construct(private EmployeeRepository $deletingEmployeeService)
    {
    }

    public function __invoke(DeletingEmployeeCommand $command): void
    {
        $employee = $this->deletingEmployeeService->findOneByEmployeeID($command->employeeID);
        if (!$employee) {
            throw new \InvalidArgumentException(sprintf('Employee with ID %d does not exist', $command->employeeID));
        }

        $this->deletingEmployeeService->delete($employee);
    }
}
