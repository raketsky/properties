<?php
declare(strict_types=1);

use App\Domain\Property\PropertyRepositoryInterface;
use App\Infrastructure\Persistence\Property\DatabasePropertyRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        PropertyRepositoryInterface::class => autowire(DatabasePropertyRepository::class),
    ]);
};
