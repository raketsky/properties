<?php
declare(strict_types=1);

namespace App\Component\Property;

use App\Component\Property\DTO\PropertyDto;
use App\Component\Property\Exception\PropertyClientException;
use App\Component\Property\ValueObject\DealType;
use GuzzleHttp\Exception\GuzzleException;
use Money\Money;
use GuzzleHttp\Client as HttpClient;

final class Client
{
    private string $baseUri;
    private string $apiKey;

    public function __construct(string $baseUri, string $apiKey)
    {
        $this->baseUri = $baseUri;
        $this->apiKey = $apiKey;
    }

    /**
     * @param int $pageNr
     * @param int $pageSize
     * @return PropertyDto[]
     * @throws PropertyClientException
     */
    public function getProperties(int $pageNr = 1, int $pageSize = 30): array
    {
        $data = $this->request('get', 'properties', [
            'page' => [
                'number' => $pageNr,
                'size' => $pageSize,
            ],
        ]);
        $propertiesData = $data['data'] ?? [];

        $properties = [];
        foreach ($propertiesData as $propertyData) {
            $data = [];
            foreach (PropertyDto::getFieldNames() as $fieldName) {
                if (in_array($fieldName, [PropertyDto::FIELD_LATITUDE, PropertyDto::FIELD_LONGITUDE])) {
                    $data[$fieldName] = (float) $propertyData[$fieldName];
                } else if (in_array($fieldName, [PropertyDto::FIELD_NUM_BEDROOMS, PropertyDto::FIELD_NUM_BATHROOMS])) {
                    $data[$fieldName] = (int) $propertyData[$fieldName];
                } else if (in_array($fieldName, [PropertyDto::FIELD_CREATED_AT, PropertyDto::FIELD_UPDATED_AT])) {
                    $data[$fieldName] = new \DateTimeImmutable($propertyData[$fieldName]);
                } else if ($fieldName === PropertyDto::FIELD_PROPERTY_TYPE_TITLE) {
                    $data[$fieldName] = $propertyData['property_type']['title'];
                } else {
                    $data[$fieldName] = $propertyData[$fieldName];
                }
            }
            $data[PropertyDto::FIELD_TYPE] = new DealType($propertyData[PropertyDto::FIELD_TYPE]);
            $data[PropertyDto::FIELD_PRICE] = Money::EUR($propertyData[PropertyDto::FIELD_PRICE]);

            $properties[] = new PropertyDto($data);
        }

        return $properties;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $query
     * @return array
     * @throws PropertyClientException
     */
    private function request(string $method, string $uri, array $query = []): array
    {
        $query['api_key'] = $this->apiKey;

        $httpBuildQuery = http_build_query($query);
        $client = new HttpClient(['base_uri' => $this->baseUri]);

        try {
            $response = $client->request($method, sprintf('/api/%s?%s', $uri, $httpBuildQuery));

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new PropertyClientException($e->getMessage(), $e->getCode());
        }
    }
}
