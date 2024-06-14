<?php

declare(strict_types=1);

namespace App\Employee\Application\Command\ImportingEmployees;

use App\Shared\Application\Bus\Command;

final readonly class ImportingEmployeesCommand implements Command
{
    /**
     * @todo fix types
     *
     * @param list<array> $employees
     */
    public function __construct(
        public array $employees,
    ) {
    }
}
