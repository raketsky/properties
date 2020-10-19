<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Property;

use App\Domain\Property\Property;
use App\Domain\Property\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DatabasePropertyRepository implements PropertyRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findAll(): Collection
    {
        return Property::all();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id): Property
    {
        return Property::findOrFail($id);
    }
}
