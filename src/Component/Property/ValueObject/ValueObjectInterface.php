<?php
namespace App\Component\Property\ValueObject;

interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    public static function instance(string $value): self;

    public function equals(ValueObjectInterface $object): bool;

    public function __toString(): string;
}
