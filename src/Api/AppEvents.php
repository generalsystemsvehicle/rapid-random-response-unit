<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class AppEvents extends Api
{
    /**
     * Get all events for an app.
     * https://developer.quickbase.com/operation/getAppEvents
     *
     * @param  string $appId
     * @return array|null
     */
    public function index($appId)
    {
        return $this->try(function() use ($appId)
        {
            return $this->client->get('v1/apps/'.$appId.'/events');
        });
    }
}
