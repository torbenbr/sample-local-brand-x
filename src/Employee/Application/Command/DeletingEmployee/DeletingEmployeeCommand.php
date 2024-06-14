<?php

declare(strict_types=1);

namespace App\Employee\Application\Command\DeletingEmployee;

use App\Shared\Application\Bus\Command;

final readonly class DeletingEmployeeCommand implements Command
{
    public function __construct(public int $employeeID)
    {
    }
}
