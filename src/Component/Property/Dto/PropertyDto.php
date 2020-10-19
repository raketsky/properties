<?php
declare(strict_types=1);

namespace App\Component\Property\DTO;

use App\Component\Property\ValueObject\DealType;
use Money\Money;

final class PropertyDto
{
    public const FIELD_UUID = 'uuid';
    public const FIELD_COUNTY = 'county';
    public const FIELD_COUNTRY = 'country';
    public const FIELD_TOWN = 'town';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_ADDRESS = 'address';
    public const FIELD_IMAGE_FULL = 'image_full';
    public const FIELD_IMAGE_THUMBNAIL = 'image_thumbnail';
    public const FIELD_LATITUDE = 'latitude';
    public const FIELD_LONGITUDE = 'longitude';
    public const FIELD_NUM_BEDROOMS = 'num_bedrooms';
    public const FIELD_NUM_BATHROOMS = 'num_bathrooms';
    public const FIELD_PRICE = 'price';
    public const FIELD_TYPE = 'type';
    public const FIELD_PROPERTY_TYPE_TITLE = 'property_type_title';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    private string $uuid;
    private string $county;
    private string $country;
    private string $town;
    private string $description;
    private string $address;
    private string $imageFull;
    private string $imageThumbnail;
    private float $latitude;
    private float $longitude;
    private int $numBedrooms;
    private int $numBathrooms;
    private Money $price;
    private DealType $type;
    private string $propertyTypeTitle;
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    public function __construct(array $parameters)
    {
        foreach ($parameters as $fieldName => $fieldValue) {
            $this->{'set'.str_replace('_', '', $fieldName)}($fieldValue);
        }
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCounty(): string
    {
        return $this->county;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getImageFull(): string
    {
        return $this->imageFull;
    }

    public function getImageThumbnail(): string
    {
        return $this->imageThumbnail;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getNumBedrooms(): int
    {
        return $this->numBedrooms;
    }

    public function getNumBathrooms(): int
    {
        return $this->numBathrooms;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getType(): DealType
    {
        return $this->type;
    }

    public function getPropertyTypeTitle(): string
    {
        return $this->propertyTypeTitle;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    private function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    private function setCounty(string $county): void
    {
        $this->county = $county;
    }

    private function setCountry(string $country): void
    {
        $this->country = $country;
    }

    private function setTown(string $town): void
    {
        $this->town = $town;
    }

    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    private function setAddress(string $address): void
    {
        $this->address = $address;
    }

    private function setImageFull(string $imageFull): void
    {
        $this->imageFull = $imageFull;
    }

    private function setImageThumbnail(string $imageThumbnail): void
    {
        $this->imageThumbnail = $imageThumbnail;
    }

    private function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    private function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    private function setNumBedrooms(int $numBedrooms): void
    {
        $this->numBedrooms = $numBedrooms;
    }

    private function setNumBathrooms(int $numBathrooms): void
    {
        $this->numBathrooms = $numBathrooms;
    }

    private function setPrice(Money $money): void
    {
        $this->price = $money;
    }

    private function setType(DealType $type): void
    {
        $this->type = $type;
    }

    private function setPropertyTypeTitle(string $propertyTypeTitle): void
    {
        $this->propertyTypeTitle = $propertyTypeTitle;
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
            static::FIELD_UUID,
            static::FIELD_COUNTY,
            static::FIELD_COUNTRY,
            static::FIELD_TOWN,
            static::FIELD_DESCRIPTION,
            static::FIELD_ADDRESS,
            static::FIELD_IMAGE_FULL,
            static::FIELD_IMAGE_THUMBNAIL,
            static::FIELD_LATITUDE,
            static::FIELD_LONGITUDE,
            static::FIELD_NUM_BEDROOMS,
            static::FIELD_NUM_BATHROOMS,
            static::FIELD_PRICE,
            static::FIELD_TYPE,
            static::FIELD_PROPERTY_TYPE_TITLE,
            static::FIELD_CREATED_AT,
            static::FIELD_UPDATED_AT,
        ];
    }
}
