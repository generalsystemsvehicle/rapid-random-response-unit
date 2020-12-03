<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use Illuminate\Support\Facades\Config;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Auth extends Api
{
    /**
     * Get a temporary auth token.
     * https://developer.quickbase.com/operation/getTempTokenDBID
     *
     * @param  string $dbId
     * @return array|null
     */
    public function temporaryToken($dbId)
    {
        return $this->get($dbId);
    }

    /**
     * Get a temporary auth token.
     * https://developer.quickbase.com/operation/getTempTokenDBID
     *
     * @param  string $dbId
     * @return array|null
     */
    public function get($dbId)
    {
        return $this->try(function() use ($dbId)
        {
            return $this->client->get('v1/auth/temporary/'.$dbId, [
                'headers' => [
                    'QB-App-Token' => Config::get('quickbase.app_token'),
                ],
            ]);
        });
    }
}
