<?php

namespace GeneralSystemsVehicle\QuickBase\Api;

use GeneralSystemsVehicle\QuickBase\Guzzle\Api;

class Files extends Api
{

    /**
     * Download a file.
     * https://developer.quickbase.com/operation/downloadFile
     *
     * @param  string $tableId
     * @param  string $recordId
     * @param  string $fieldId
     * @param  string $versionNumber
     * @return array|null
     */
    public function download($tableId, $recordId, $fieldId, $versionNumber)
    {
        return $this->get($tableId, $recordId, $fieldId, $versionNumber);
    }

    /**
     * Download a file.
     * https://developer.quickbase.com/operation/downloadFile
     *
     * @param  string $tableId
     * @param  string $recordId
     * @param  string $fieldId
     * @param  string $versionNumber
     * @return array|null
     */
    public function get($tableId, $recordId, $fieldId, $versionNumber)
    {
        return $this->try(function() use ($tableId, $recordId, $fieldId, $versionNumber)
        {
            return $this->client->get('v1/files/'.
                $tableId.'/'.
                $recordId.'/'.
                $fieldId.'/'.
                $versionNumber
            );
        });
    }

    /**
     * Delete a file.
     * https://developer.quickbase.com/operation/deleteFile
     *
     * @param  string $tableId
     * @param  string $recordId
     * @param  string $fieldId
     * @param  string $versionNumber
     * @return array|null
     */
    public function delete($tableId, $recordId, $fieldId, $versionNumber)
    {
        return $this->try(function() use ($tableId, $recordId, $fieldId, $versionNumber)
        {
            return $this->client->delete('v1/files/'.
                $tableId.'/'.
                $recordId.'/'.
                $fieldId.'/'.
                $versionNumber
            );
        });
    }
}
