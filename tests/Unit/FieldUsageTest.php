<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\FieldUsage;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class FieldUsageTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/FieldUsage/index.json')),
        ]);

        $api = new FieldUsage(['mock' => $mock]);

        $response = $api->index('bck7gp3q2', [
            'skip' => 0,
            'top' => 1,
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('field', $response[0]));
        $this->assertTrue(array_key_exists('usage', $response[0]));
    }

    /** @test */
    function it_gets_a_single_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/FieldUsage/get.json')),
        ]);

        $api = new FieldUsage(['mock' => $mock]);

        $response = $api->get('bck7gp3q2', 6);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('field', $response[0]));
        $this->assertTrue(array_key_exists('usage', $response[0]));
    }
}
