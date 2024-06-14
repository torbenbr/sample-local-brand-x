<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Endpoint\ApiResource;

use ApiPlatform\Metadata\Post;
use App\Employee\Infrastructure\Endpoint\State\EmployeeProcessor;

#[Post(uriTemplate: '/employee', formats: ['csv'], processor: EmployeeProcessor::class)]
final readonly class Employees
{
}
