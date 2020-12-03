<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Fields extends Api
{
    /**
     * Get all fields for a table.
     * https://developer.quickbase.com/operation/getFields
     *
     * @param  string $tableId
     * @param  array  $payload
     * @return array|null
     */
    public function index($tableId, $payload = [])
    {
        return $this->try(function() use ($tableId, $payload)
        {
            return $this->client->get('v1/fields', [
                'query' => [
                    'tableId' => $tableId,
                    'includeFieldPerms' => Arr::get($payload, 'includeFieldPerms', false),
                ],
            ]);
        });
    }

    /**
     * Get a field.
     * https://developer.quickbase.com/operation/getField
     *
     * @param  string $tableId
     * @param  string $fieldId
     * @param  array  $payload
     * @return array|null
     */
    public function get($tableId, $fieldId, $payload = [])
    {
        return $this->try(function() use ($tableId, $fieldId, $payload)
        {
            return $this->client->get('v1/fields/'.$fieldId, [
                'query' => [
                    'tableId' => $tableId,
                    'includeFieldPerms' => Arr::get($payload, 'includeFieldPerms', false),
                ],
            ]);
        });
    }

    /**
     * Create a field.
     * https://developer.quickbase.com/operation/createField
     *
     * @param  string $tableId
     * @param  array  $payload
     * @return array|null
     */
    public function create($tableId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        if (! Arr::has($payload, 'fieldType')) {
            return null;
        }

        return $this->try(function() use ($tableId, $payload)
        {
            return $this->client->post('v1/fields', [
                'body' => json_encode($payload),
                'query' => [
                    'tableId' => $tableId,
                ],
            ]);
        });
    }

    /**
     * Update a field.
     * https://developer.quickbase.com/operation/updateField
     *
     * @param  string $tableId
     * @param  string $fieldId
     * @param  array  $payload
     * @return array|null
     */
    public function update($tableId, $fieldId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        return $this->try(function() use ($tableId, $fieldId, $payload)
        {
            return $this->client->post('v1/fields/'.$fieldId, [
                'body' => json_encode($payload),
                'query' => [
                    'tableId' => $tableId,
                ],
            ]);
        });
    }

    /**
     * Delete a field.
     * https://developer.quickbase.com/operation/deleteFields
     *
     * @param  string $tableId
     * @param  array  $payload
     * @return array|null
     */
    public function delete($tableId, $payload)
    {
        if (! Arr::has($payload, 'fieldIds')) {
            return null;
        }

        return $this->try(function() use ($tableId, $payload)
        {
            return $this->client->delete('v1/fields', [
                'body' => json_encode($payload),
                'query' => [
                    'tableId' => $tableId,
                ],
            ]);
        });
    }
}
