<?php

declare(strict_types=1);

namespace App\Employee\Application\Command\ImportingEmployee;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeRepository;

final readonly class ImportingEmployeeCommandHandler
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
    }

    public function __invoke(ImportingEmployeeCommand $command): void
    {
        $this->validate($command);

        $employee = $this->employeeRepository->findOneByEmployeeID($command->employeeID);
        if (!$employee) {
            $employee = Employee::importFirst(
                $command->employeeID,
                $command->userName,
                $command->namePrefix,
                $command->firstName,
                $command->middleInitial,
                $command->lastName,
                $command->gender,
                $command->email,
                $command->dateOfBirth,
                $command->timeOfBirth,
                $command->dateOfJoining,
                $command->phoneNo,
                $command->placeName,
                $command->county,
                $command->city,
                $command->zip,
                $command->region,
            );
        } else {
            $employee->import(
                $command->userName,
                $command->namePrefix,
                $command->firstName,
                $command->middleInitial,
                $command->lastName,
                $command->gender,
                $command->email,
                $command->dateOfBirth,
                $command->timeOfBirth,
                $command->dateOfJoining,
                $command->phoneNo,
                $command->placeName,
                $command->county,
                $command->city,
                $command->zip,
                $command->region,
            );
        }

        $this->employeeRepository->store($employee);
    }

    private function validate(ImportingEmployeeCommand $command): void
    {
        if ($command->employeeID < 0) {
            throw new \InvalidArgumentException('Employee ID must be greater than 0');
        }

        if (empty($command->userName)) {
            throw new \InvalidArgumentException('User name must not be empty');
        }

        if (empty($command->namePrefix)) {
            throw new \InvalidArgumentException('Name prefix must not be empty');
        }

        if (\strlen($command->namePrefix) > 5) {
            throw new \InvalidArgumentException('Name prefix must not be greater than 5 characters');
        }

        if (empty($command->firstName)) {
            throw new \InvalidArgumentException('First name must not be empty');
        }

        if (empty($command->middleInitial)) {
            throw new \InvalidArgumentException('Middle initial must not be empty');
        }

        if (\strlen($command->middleInitial) > 1) {
            throw new \InvalidArgumentException('Middle initial must not be greater than 1 character');
        }

        if (empty($command->lastName)) {
            throw new \InvalidArgumentException('Last name must not be empty');
        }

        if (!strtotime($command->dateOfBirth)) {
            throw new \InvalidArgumentException('Date of birth must be a valid date');
        }

        if (!strtotime($command->timeOfBirth)) {
            throw new \InvalidArgumentException('Time of birth must be a valid time');
        }

        if (!is_numeric($command->ageInYrs)) {
            throw new \InvalidArgumentException('Age in years must be numeric');
        }

        if (!strtotime($command->dateOfJoining)) {
            throw new \InvalidArgumentException('Date of joining must be a valid date');
        }

        if (!is_numeric($command->ageInCompanyInYrs)) {
            throw new \InvalidArgumentException('Age in company in years must be numeric');
        }

        if (empty($command->phoneNo)) {
            throw new \InvalidArgumentException('Phone number must not be empty');
        }

        if (empty($command->placeName)) {
            throw new \InvalidArgumentException('Place name must not be empty');
        }

        if (empty($command->county)) {
            throw new \InvalidArgumentException('County must not be empty');
        }

        if (empty($command->city)) {
            throw new \InvalidArgumentException('City must not be empty');
        }

        if (empty($command->zip)) {
            throw new \InvalidArgumentException('Zip must not be empty');
        }

        if (!is_numeric($command->zip)) {
            throw new \InvalidArgumentException('Zip must be numeric');
        }

        if (empty($command->region)) {
            throw new \InvalidArgumentException('Region must not be empty');
        }
    }
}
