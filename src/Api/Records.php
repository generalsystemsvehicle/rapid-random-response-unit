<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Records extends Api
{
    /**
     * Get records with a query.
     * https://developer.quickbase.com/operation/runQuery
     *
     * @param  array  $payload
     * @return array|null
     */
    public function query($payload = [])
    {
        return $this->index($payload);
    }

    /**
     * Get records with a query.
     * https://developer.quickbase.com/operation/runQuery
     *
     * @param  array  $payload
     * @return array|null
     */
    public function index($payload = [])
    {
        if (! Arr::has($payload, 'from')) {
            return null;
        }

        return $this->try(function() use ($payload)
        {
            return $this->client->get('v1/records/query', [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Create a record.
     * https://developer.quickbase.com/operation/upsert
     *
     * @param  array  $payload
     * @return array|null
     */
    public function create($payload = [])
    {
        return $this->upsert($payload);
    }

    /**
     * Update a record.
     * https://developer.quickbase.com/operation/upsert
     *
     * @param  array  $payload
     * @return array|null
     */
    public function update($payload = [])
    {
        return $this->upsert($payload);
    }

    /**
     * Create/update a record.
     * https://developer.quickbase.com/operation/upsert
     *
     * @param  array  $payload
     * @return array|null
     */
    public function upsert($payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        if (! Arr::has($payload, 'to')) {
            return null;
        }

        return $this->try(function() use ($payload)
        {
            return $this->client->post('v1/records', [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Delete record(s).
     * https://developer.quickbase.com/operation/deleteRecords
     *
     * @param  array  $payload
     * @return array|null
     */
    public function delete($payload = [])
    {
        if (! Arr::has($payload, 'from')) {
            return null;
        }

        if (! Arr::has($payload, 'where')) {
            return null;
        }

        return $this->try(function() use ($payload)
        {
            return $this->client->delete('v1/records', [
                'body' => json_encode($payload),
            ]);
        });
    }
}
