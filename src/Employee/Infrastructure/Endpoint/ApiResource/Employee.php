<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Endpoint\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Employee\Domain\EmployeeView;
use App\Employee\Infrastructure\Endpoint\State\DeleteEmployeeProcessor;
use App\Employee\Infrastructure\Endpoint\State\EmployeeProvider;
use App\Employee\Infrastructure\Endpoint\State\EmployeesProvider;

#[Get(uriTemplate: '/employee/{employeeID}', provider: EmployeeProvider::class)]
#[GetCollection(uriTemplate: '/employee', provider: EmployeesProvider::class)]
#[Delete(uriTemplate: '/employee/{employeeID}', provider: EmployeeProvider::class, processor: DeleteEmployeeProcessor::class)]
final class Employee
{
    public static function fromEmployeeView(EmployeeView $employee): self
    {
        return new self(
            $employee->employeeID,
            $employee->userName,
            $employee->namePrefix,
            $employee->firstName,
            $employee->middleInitial,
            $employee->lastName,
            $employee->gender,
            $employee->email,
            $employee->dateOfBirth,
            $employee->timeOfBirth,
            $employee->ageInYrs,
            $employee->dateOfJoining,
            $employee->ageInCompanyInYrs,
            $employee->phoneNo,
            $employee->placeName,
            $employee->county,
            $employee->city,
            $employee->zip,
            $employee->region,
        );
    }

    private function __construct(
        #[ApiProperty(identifier: true)]
        public int $employeeID,
        public string $userName,
        public string $namePrefix,
        public string $firstName,
        public string $middleInitial,
        public string $lastName,
        public string $gender,
        public string $email,
        public string $dateOfBirth,
        public string $timeOfBirth,
        public float $ageInYrs,
        public string $dateOfJoining,
        public float $ageInCompanyInYrs,
        public string $phoneNo,
        public string $placeName,
        public string $county,
        public string $city,
        public string $zip,
        public string $region,
    ) {
    }
}
