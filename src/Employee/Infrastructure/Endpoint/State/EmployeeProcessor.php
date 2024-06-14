<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Endpoint\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Employee\Application\Command\ImportingEmployees\ImportingEmployeesCommand;
use App\Employee\Infrastructure\Endpoint\ApiResource\Employees;
use App\Shared\Application\Bus\CommandBus;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * @implements ProcessorInterface<Employees>
 */
final readonly class EmployeeProcessor implements ProcessorInterface
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    #[\Override]
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): null
    {
        $request = $context['request'];
        // @todo validate content
        $content = $request->getContent();

        $serializer = new Serializer(encoders: [new CsvEncoder()]);
        $employees = $serializer->decode($content, 'csv');
        $this->commandBus->execute(new ImportingEmployeesCommand($employees));

        return null;
    }
}
