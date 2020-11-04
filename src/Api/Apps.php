<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Apps extends Api
{
    /**
     * Get an app.
     * https://developer.quickbase.com/operation/getApp
     *
     * @param  string $appId
     * @return array|null
     */
    public function get($appId)
    {
        return $this->try(function() use ($appId)
        {
            return $this->client->get('v1/apps/'.$appId);
        });
    }

    /**
     * Create an app.
     * https://developer.quickbase.com/operation/createApp
     *
     * @param  array  $payload
     * @return array|null
     */
    public function create($payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        if (! Arr::has($payload, 'name')) {
            return null;
        }

        return $this->try(function() use ($payload)
        {
            return $this->client->post('v1/apps', [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Update an app.
     * https://developer.quickbase.com/operation/updateApp
     *
     * @param  string $appId
     * @param  array  $payload
     * @return array|null
     */
    public function update($appId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        return $this->try(function() use ($appId, $payload)
        {
            return $this->client->post('v1/apps/'.$appId, [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Copy an app.
     * https://developer.quickbase.com/operation/copyApp
     *
     * @param  string $appId
     * @param  array  $payload
     * @return array|null
     */
    public function copy($appId, $payload = [])
    {
        if (count($payload) == 0) {
            return null;
        }

        if (! Arr::has($payload, 'name')) {
            return null;
        }

        return $this->try(function() use ($appId, $payload)
        {
            return $this->client->post('v1/apps/'.$appId.'/copy', [
                'body' => json_encode($payload),
            ]);
        });
    }

    /**
     * Delete an app.
     * https://developer.quickbase.com/operation/deleteApp
     *
     * @param  string $appId
     * @param  array  $payload
     * @return array|null
     */
    public function delete($appId, $payload = [])
    {
        if (! Arr::has($payload, 'name')) {
            return null;
        }

        return $this->try(function() use ($appId, $payload)
        {
            return $this->client->delete('v1/apps/'.$appId, [
                'body' => json_encode($payload),
            ]);
        });
    }
}
