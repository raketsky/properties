<?php
declare(strict_types=1);

namespace App\Application\Actions\Property;

use App\Application\Actions\Action;
use App\Domain\Property\PropertyRepositoryInterface;
use App\Service\MoneyService;
use Psr\Log\LoggerInterface;

abstract class PropertyAction extends Action
{
    protected PropertyRepositoryInterface $propertyRepository;

    public function __construct(LoggerInterface $logger, PropertyRepositoryInterface $propertyRepository)
    {
        parent::__construct($logger);
        $this->propertyRepository = $propertyRepository;
    }
}
