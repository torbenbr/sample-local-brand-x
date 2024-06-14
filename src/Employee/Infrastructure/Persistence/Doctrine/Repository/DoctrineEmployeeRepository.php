<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Persistence\Doctrine\Repository;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 */
final class DoctrineEmployeeRepository extends ServiceEntityRepository implements EmployeeRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    #[\Override]
    public function findOneByEmployeeID(int $employeeID): ?Employee
    {
        return $this->findOneBy([
            'employeeID' => $employeeID,
        ]);
    }

    #[\Override]
    public function findAllWithLimitAndOffset(int $limit, int $offset): array
    {
        return $this->findBy([], [], $limit, $offset);
    }

    #[\Override]
    public function store(Employee $employee): void
    {
        $this->getEntityManager()->persist($employee);
        $this->getEntityManager()->flush();
    }

    #[\Override]
    public function delete(Employee $employee): void
    {
        $this->getEntityManager()->remove($employee);
        $this->getEntityManager()->flush();
    }
}
