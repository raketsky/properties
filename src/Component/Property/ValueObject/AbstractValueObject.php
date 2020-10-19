<?php
declare(strict_types=1);

namespace App\Component\Property\ValueObject;

use App\Component\Property\Exception\ValueObjectValidationException;

abstract class AbstractValueObject implements ValueObjectInterface
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $this->getValidValue($value);
    }

    protected function getValidationException($value): ValueObjectValidationException
    {
        return new ValueObjectValidationException($this, $value);
    }

    protected function isValidValue(string $value): bool
    {
        return true;
    }

    protected function getValidValue(string $value): string
    {
        if ($this->isValidValue($value)) {
            return $value;
        }

        throw $this->getValidationException($value);
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }

    /**
     * @inheritDoc
     */
    public static function instance(string $value): self
    {
        return new static($value);
    }


    /**
     * @inheritDoc
     */
    public function equals(ValueObjectInterface $object): bool
    {
        return $object instanceof static && $object->getValue() === $this->getValue();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
