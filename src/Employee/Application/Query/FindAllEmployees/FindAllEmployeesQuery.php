<?php

declare(strict_types=1);

namespace App\Employee\Application\Query\FindAllEmployees;

use App\Shared\Application\Bus\Query;

final readonly class FindAllEmployeesQuery implements Query
{
    public function __construct(
        public int $limit,
        public int $offset,
    ) {
    }
}
