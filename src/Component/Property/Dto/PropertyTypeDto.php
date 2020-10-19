<?php
declare(strict_types=1);

namespace App\Component\Property\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class PropertyTypeDto
{
    private const FIELD_ID = 'id';
    private const FIELD_TITLE = 'title';
    private const FIELD_DESCRIPTION = 'description';
    private const FIELD_CREATED_AT = 'created_at';
    private const FIELD_UPDATED_AT = 'updated_at';

    /**
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private int $id;

    /**
     * @Assert\NotBlank
     */
    private string $title;

    /**
     * @Assert\NotBlank
     */
    private string $description;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt;

    public function __construct(array $parameters)
    {
        foreach ($parameters as $fieldName => $fieldValue) {
            $this->{'set'.$fieldName}($fieldValue);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    private function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    private function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public static function getFieldNames(): array
    {
        return [
            static::FIELD_ID,
            static::FIELD_TITLE,
            static::FIELD_DESCRIPTION,
            static::FIELD_CREATED_AT,
            static::FIELD_UPDATED_AT,
        ];
    }
}
