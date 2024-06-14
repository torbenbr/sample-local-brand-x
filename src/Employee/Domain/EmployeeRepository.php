<?php

declare(strict_types=1);

namespace App\Employee\Domain;

interface EmployeeRepository
{
    public function findOneByEmployeeID(int $employeeID): ?Employee;

    /**
     * @return list<Employee>
     */
    public function findAllWithLimitAndOffset(int $limit, int $offset): array;

    public function store(Employee $employee): void;

    public function delete(Employee $employee): void;
}
