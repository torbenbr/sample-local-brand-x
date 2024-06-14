<?php

declare(strict_types=1);

namespace App\Employee\Application\Command\ImportingEmployees;

use App\Employee\Application\Command\ImportingEmployee\ImportingEmployeeCommand;
use App\Shared\Application\Bus\CommandBus;

final readonly class ImportingEmployeesCommandHandler
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(ImportingEmployeesCommand $command): void
    {
        foreach ($command->employees as $employee) {
            $this->commandBus->execute(
                new ImportingEmployeeCommand(
                    (int) $employee['Emp ID'],
                    $employee['User Name'],
                    $employee['Name Prefix'],
                    $employee['First Name'],
                    $employee['Middle Initial'],
                    $employee['Last Name'],
                    $employee['Gender'],
                    $employee['E Mail'],
                    $employee['Date of Birth'],
                    $employee['Time of Birth'],
                    (float) $employee['Age in Yrs'][9],
                    $employee['Date of Joining'],
                    (float) $employee['Age in Company (Years)'],
                    $employee['Phone No'][' '],
                    $employee['Place Name'],
                    $employee['County'],
                    $employee['City'],
                    $employee['Zip'],
                    $employee['Region'],
                )
            );
        }
    }
}
