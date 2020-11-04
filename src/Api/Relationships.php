<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Relationships extends Api
{
    /**
     * Get all relationships for a table.
     * https://developer.quickbase.com/operation/getRelationships
     *
     * @param  string $tableId
     * @param  array  $payload
     * @return array|null
     */
    public function index($tableId, $payload = [])
    {
        return $this->try(function() use ($tableId, $payload)
        {
            return $this->client->get('v1/tables/'.$tableId.'/relationships', [
                'query' => [
                    'skip' => Arr::get($payload, 'skip', 0),
                    'top' => Arr::get($payload, 'top', 100),
                ],
            ]);
        });
    }

    /**
     * Create a relationship for a table.
     * https://developer.quickbase.com/operation/createRelationship
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

        if (! Arr::has($payload, 'parentTableId')) {
            return null;
        }

        return $this->try(function() use ($tableId, $payload)
        {
            return $this->client->post('v1/tables/'.$tableId.'/relationship', [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Update a relationship for a table.
     * https://developer.quickbase.com/operation/updateRelationship
     *
     * @param  string $tableId
     * @param  int $relationshipId
     * @param  array  $payload
     * @return array|null
     */
    public function update($tableId, $relationshipId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        return $this->try(function() use ($tableId, $relationshipId, $payload)
        {
            return $this->client->post('v1/tables/'.$tableId.'/relationship/'.$relationshipId, [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Delete a relationship from a table.
     * https://developer.quickbase.com/operation/deleteRelationship
     *
     * @param  string $tableId
     * @param  string $relationshipId
     * @return array|null
     */
    public function delete($tableId, $relationshipId)
    {

        return $this->try(function() use ($tableId, $relationshipId)
        {
            return $this->client->delete('v1/tables/'.$tableId.'/relationship/'.$relationshipId);
        });
    }
}
