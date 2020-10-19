<?php
declare(strict_types=1);

namespace App\Domain\Property;

use App\Component\Property\ValueObject\DealType;
use App\Service\MoneyService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Money\Money;

/**
 * @property int id
 * @property string uuid
 * @property string county
 * @property string country
 * @property string town
 * @property string description
 * @property string address
 * @property string image_full
 * @property string image_thumbnail
 * @property float latitude
 * @property float longitude
 * @property int num_bedrooms
 * @property int num_bathrooms
 * @property Money price
 * @property DealType type
 * @property string property_type_title
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Property extends Model
{
    public $fillable = ['uuid'];

    public function getPriceAttribute($value): Money
	{
	    return Money::EUR($value);
	}

    public function getTypeAttribute($value): DealType
	{
	    return new DealType($value);
	}

	public function getPriceFormatted()
    {
        $moneyService = new MoneyService();

        return $moneyService->formatAmountAsDecimal($this->price);
    }

    public function getUrl()
    {
        return sprintf('/property/%d', $this->id);
    }

    public function setPriceAttribute(Money $value): void
	{
	    $this->attributes['price'] = (int) $value->getAmount();
	}

    public function setTypeAttribute(DealType $value): void
	{
	    $this->attributes['type'] = $value->getValue();
	}
}