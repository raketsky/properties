<?php
declare(strict_types=1);

namespace App\Application\Actions\Property;

use App\Domain\Property\PropertyRepositoryInterface;
use App\Service\MoneyService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

final class PropertyViewAction extends PropertyAction
{
    private MoneyService $moneyService;

    public function __construct(
        LoggerInterface $logger,
        PropertyRepositoryInterface $propertyRepository,
        MoneyService $moneyService
    ) {
        parent::__construct($logger, $propertyRepository);

        $this->moneyService = $moneyService;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $propertyId = (int) $this->request->getAttribute('id');
        $this->logger->info(sprintf('Property of id %d was viewed', $propertyId));

        $property = $this->propertyRepository->findOneById($propertyId);

        $attributes = [
            ['title' => 'County', 'value' => $property->county,],
            ['title' => 'Country', 'value' => $property->country,],
            ['title' => 'Town', 'value' => $property->town,],
            ['title' => 'Description', 'value' => $property->description,],
            ['title' => 'Displayable Address', 'value' => $property->address,],
            ['title' => 'Image', 'value' => $property->image_thumbnail,],
            ['title' => 'Number of Bedrooms', 'value' => $property->num_bedrooms,],
            ['title' => 'Number of Bathrooms', 'value' => $property->num_bathrooms,],
            ['title' => 'Price', 'value' => $this->moneyService->formatAmountAsDecimal($property->price),],
            ['title' => 'Property Type', 'value' => $property->property_type_title,],
            ['title' => 'Deal Type', 'value' => $property->type->getValue(),],
        ];

        return $this->render('property.item', [
            'property' => $property,
            'attributes' => $attributes,
        ]);
    }
}
