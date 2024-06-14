<?php

declare(strict_types=1);

namespace App\Employee\Application\Command\ImportingEmployee;

use App\Shared\Application\Bus\Command;

final readonly class ImportingEmployeeCommand implements Command
{
    public function __construct(
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
