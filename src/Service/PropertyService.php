<?php
declare(strict_types=1);

namespace App\Service;

use App\Component\Property\DTO\PropertyDto;
use App\Domain\Property\Property;

class PropertyService
{
    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param PropertyDto $propertyDto
     * @throws \Exception
     */
    public function saveFromDto(PropertyDto $propertyDto, ?\DateTimeImmutable $updatedAt = null): void
    {
        // todo add validation

        $property = Property::firstOrNew(['uuid' => $propertyDto->getUuid()]);
        $property->county = $propertyDto->getCounty();
        $property->country = $propertyDto->getCountry();
        $property->town = $propertyDto->getTown();
        $property->description = $propertyDto->getDescription();
        $property->address = $propertyDto->getAddress();
        $property->image_full = $propertyDto->getImageFull();
        $property->image_thumbnail = $propertyDto->getImageThumbnail();
        $property->latitude = $propertyDto->getLatitude();
        $property->longitude = $propertyDto->getLongitude();
        $property->num_bedrooms = $propertyDto->getNumBedrooms();
        $property->num_bathrooms = $propertyDto->getNumBathrooms();
        $property->price = $propertyDto->getPrice();
        $property->type = $propertyDto->getType();
        $property->property_type_title = $propertyDto->getPropertyTypeTitle();
        if (null !== $updatedAt) {
            $property->updated_at = $updatedAt;
        }

        if (!$property->save()) {
            throw new \Exception('Unable to save Property');
        }
    }

    public function removePropertiesOlderThan(\DateTimeImmutable $dateTimeImmutable): int
    {
        return Property::where('updated_at', '<', $dateTimeImmutable->format(static::DATE_TIME_FORMAT))
            ->delete();
    }
}
