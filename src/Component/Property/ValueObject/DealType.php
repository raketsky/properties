<?php
declare(strict_types=1);

namespace App\Component\Property\ValueObject;

final class DealType extends AbstractValueObject
{
    public const RENT = 'rent';
    public const SALE = 'sale';

    public static function getValues(): array
    {
        return [
            static::RENT,
            static::SALE,
        ];
    }

    protected function isValidValue($value): bool
    {
        return in_array($value, static::getValues());
    }
}
