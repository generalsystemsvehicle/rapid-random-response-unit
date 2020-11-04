<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Reports;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class ReportsTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Reports/index.json')),
        ]);

        $api = new Reports(['mock' => $mock]);

        $response = $api->index('bck7gp3q2');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response[0]));
        $this->assertTrue(array_key_exists('name', $response[0]));
        $this->assertTrue(array_key_exists('type', $response[0]));
        $this->assertTrue(array_key_exists('description', $response[0]));
        $this->assertTrue(array_key_exists('query', $response[0]));
        $this->assertTrue(array_key_exists('properties', $response[0]));
        $this->assertTrue(array_key_exists('usedLast', $response[0]));
        $this->assertTrue(array_key_exists('usedCount', $response[0]));
    }

    /** @test */
    function it_gets_a_single_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Reports/get.json')),
        ]);

        $api = new Reports(['mock' => $mock]);

        $response = $api->get('bpweef42b', 5);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('type', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('query', $response));
        $this->assertTrue(array_key_exists('properties', $response));
        $this->assertTrue(array_key_exists('usedLast', $response));
        $this->assertTrue(array_key_exists('usedCount', $response));
    }

    /** @test */
    function it_runs_a_report()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Reports/run.json')),
        ]);

        $api = new Reports(['mock' => $mock]);

        $response = $api->run('bpweef42b', 5, [
            'skip' => 0,
            'top' => 1,
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('data', $response));
        $this->assertTrue(array_key_exists('fields', $response));
        $this->assertTrue(array_key_exists('metadata', $response));
    }
}
