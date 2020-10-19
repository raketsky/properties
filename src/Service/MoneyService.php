<?php
declare(strict_types=1);

namespace App\Service;

use App\Component\Property\DTO\PropertyDto;
use App\Domain\Property\Property;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class MoneyService
{
    private DecimalMoneyFormatter $decimalMoneyFormatter;

    public function __construct()
    {
        $currencies = new ISOCurrencies();
        $this->decimalMoneyFormatter = new DecimalMoneyFormatter($currencies);
    }

    /**
     * @param Money $money
     * @return false|string
     */
    public function formatAmountAsDecimal(Money $money)
    {
        return $this->decimalMoneyFormatter->format($money);
    }
}
