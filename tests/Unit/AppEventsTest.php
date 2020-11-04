<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\AppEvents;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class AppEventsTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/AppEvents/index.json')),
        ]);

        $api = new AppEvents(['mock' => $mock]);

        $response = $api->index('bpqe82s1');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('type', $response[0]));
        $this->assertTrue(array_key_exists('owner', $response[0]));
        $this->assertTrue(array_key_exists('isActive', $response[0]));
        $this->assertTrue(array_key_exists('tableId', $response[0]));
        $this->assertTrue(array_key_exists('name', $response[0]));
    }
}
