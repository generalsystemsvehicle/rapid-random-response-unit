<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use Illuminate\Support\Arr;
use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Reports extends Api
{
    /**
     * Get all reports for a table.
     * https://developer.quickbase.com/operation/getTableReports
     *
     * @param  string $tableId
     * @return array|null
     */
    public function index($tableId)
    {
        return $this->try(function() use ($tableId)
        {
            return $this->client->get('v1/reports', [
                'query' => [
                    'tableId' => $tableId,
                ],
            ]);
        });
    }

    /**
     * Get a report.
     * https://developer.quickbase.com/operation/getReport
     *
     * @param  string $tableId
     * @param  int $reportId
     * @return array|null
     */
    public function get($tableId, $reportId)
    {
        return $this->try(function() use ($tableId, $reportId)
        {
            return $this->client->get('v1/reports/'.$reportId, [
                'query' => [
                    'tableId' => $tableId,
                ],
            ]);
        });
    }

    /**
     * Run a report.
     * https://developer.quickbase.com/operation/runReport
     *
     * @param  string $tableId
     * @param  int $reportId
     * @param  array  $payload
     * @return array|null
     */
    public function run($tableId, $reportId, $payload = [])
    {
        return $this->try(function() use ($tableId, $reportId, $payload)
        {
            return $this->client->get('v1/reports/'.$reportId, [
                'query' => [
                    'tableId' => $tableId,
                    'skip' => Arr::get($payload, 'skip', 0),
                    'top' => Arr::get($payload, 'skip', 100),
                ],
            ]);
        });
    }
}
