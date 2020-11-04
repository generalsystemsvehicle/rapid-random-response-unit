<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class FieldUsage extends Api
{
    /**
     * Get usage for all fields in a table.
     * https://developer.quickbase.com/operation/getFieldsUsage
     *
     * @param  string $tableId
     * @param  array  $payload
     * @return array|null
     */
    public function index($tableId, $payload = [])
    {
        return $this->try(function() use ($tableId, $payload)
        {
            return $this->client->get('v1/fields/usage', [
                'query' => [
                    'tableId' => $tableId,
                    'skip' => Arr::get($payload, 'skip', 0),
                    'top' => Arr::get($payload, 'top', 100),
                ],
            ]);
        });
    }

    /**
     * Get usage for a field.
     * https://developer.quickbase.com/operation/getFieldUsage
     *
     * @param  string $tableId
     * @param  string $fieldId
     * @return array|null
     */
    public function get($tableId, $fieldId)
    {
        return $this->try(function() use ($tableId, $fieldId)
        {
            return $this->client->get('v1/fields/usage/'.$fieldId, [
                'query' => [
                    'tableId' => $tableId,
                ],
            ]);
        });
    }
}
