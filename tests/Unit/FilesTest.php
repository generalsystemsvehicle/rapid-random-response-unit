<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Files;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class FilesTest extends TestCase
{
    /** @test */
    function it_downloads_a_file()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Files/get.json')),
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Files/get.json')),
        ]);

        $api = new Files(['mock' => $mock]);

        $response = $api->download('bck7gp3q2', 1, 123, 1);

        $this->assertTrue(is_string($response));

        $response = $api->get('bck7gp3q2', 1, 123, 1);

        $this->assertTrue(is_string($response));
    }

    /** @test */
    function it_deletes_a_file()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Files/delete.json')),
        ]);

        $api = new Files(['mock' => $mock]);

        $response = $api->delete('bck7gp3q2', 1, 123, 1);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('versionNumber', $response));
        $this->assertTrue(array_key_exists('fileName', $response));
        $this->assertTrue(array_key_exists('uploaded', $response));
        $this->assertTrue(array_key_exists('creator', $response));
    }
}
