<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Tables extends Api
{
    /**
     * Get all tables for an app.
     * https://developer.quickbase.com/operation/getAppTables
     *
     * @param  string $appId
     * @return array|null
     */
    public function index($appId)
    {
        return $this->try(function() use ($appId)
        {
            return $this->client->get('v1/tables', [
                'query' => [
                    'appId' => $appId,
                ],
            ]);
        });
    }

    /**
     * Get a table.
     * https://developer.quickbase.com/operation/getTable
     *
     * @param  string $appId
     * @param  string $tableId
     * @return array|null
     */
    public function get($appId, $tableId)
    {
        return $this->try(function() use ($appId, $tableId)
        {
            return $this->client->get('v1/tables/'.$tableId, [
                'query' => [
                    'appId' => $appId,
                ],
            ]);
        });
    }

    /**
     * Create a table.
     * https://developer.quickbase.com/operation/createTable
     *
     * @param  string $appId
     * @param  array  $payload
     * @return array|null
     */
    public function create($appId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        if (! Arr::has($payload, 'name')) {
            return null;
        }

        return $this->try(function() use ($appId, $payload)
        {
            return $this->client->post('v1/tables', [
                'body' => json_encode($payload),
                'query' => [
                    'appId' => $appId,
                ],
            ]);
        });
    }

    /**
     * Update a table.
     * https://developer.quickbase.com/operation/updateTable
     *
     * @param  string $appId
     * @param  string $tableId
     * @param  array  $payload
     * @return array|null
     */
    public function update($appId, $tableId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        return $this->try(function() use ($appId, $tableId, $payload)
        {
            return $this->client->post('v1/tables/'.$tableId, [
                'body' => json_encode($payload),
                'query' => [
                    'appId' => $appId,
                ],
            ]);
        });
    }

    /**
     * Delete a table.
     * https://developer.quickbase.com/operation/deleteTable
     *
     * @param  string $appId
     * @param  string $tableId
     * @return array|null
     */
    public function delete($appId, $tableId)
    {
        return $this->try(function() use ($appId, $tableId)
        {
            return $this->client->delete('v1/tables/'.$tableId, [
                'query' => [
                    'appId' => $appId,
                ],
            ]);
        });
    }
}
