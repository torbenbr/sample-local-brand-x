<?php

declare(strict_types=1);

namespace App\Employee\Domain;

final readonly class EmployeeView
{
    public static function fromEmployee(Employee $employee): self
    {
        return new self(
            $employee->getEmployeeID(),
            $employee->getUserName(),
            $employee->getNamePrefix(),
            $employee->getFirstName(),
            $employee->getMiddleInitial(),
            $employee->getLastName(),
            $employee->getGender(),
            $employee->getEmail(),
            $employee->getDateOfBirth(),
            $employee->getTimeOfBirth(),
            $employee->getAgeInYrs(),
            $employee->getDateOfJoining(),
            $employee->getAgeInCompany(),
            $employee->getPhoneNo(),
            $employee->getPlaceName(),
            $employee->getCounty(),
            $employee->getCity(),
            $employee->getZip(),
            $employee->getRegion(),
        );
    }

    private function __construct(
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
