<?php

declare(strict_types=1);

namespace App\Employee\Application\Query\FindEmployee;

use App\Shared\Application\Bus\Query;

final readonly class FindEmployeeQuery implements Query
{
    public function __construct(public int $employeeID)
    {
    }
}
