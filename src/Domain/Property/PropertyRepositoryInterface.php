<?php
declare(strict_types=1);

namespace App\Domain\Property;

interface PropertyRepositoryInterface
{
    /**
     * @return Property[]
     */
    public function findAll(): iterable;

    /**
     * @param int $id
     * @return Property
     * @throws \Exception
     */
    public function findOneById(int $id): Property;
}
