<?php
declare(strict_types=1);

namespace App\Application\Actions\Property;

use Psr\Http\Message\ResponseInterface as Response;

final class PropertiesListAction extends PropertyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $this->logger->info('Properties list was viewed');

        $properties = $this->propertyRepository->findAll();

        return $this->render('property.list', [
            'properties' => $properties,
        ]);
    }
}
