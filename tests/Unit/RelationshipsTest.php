<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Relationships;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class RelationshipsTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Relationships/index.json')),
        ]);

        $api = new Relationships(['mock' => $mock]);

        $response = $api->index('bck7gp3q2', [
            'skip' => 0,
            'top' => 1,
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('metadata', $response));
        $this->assertTrue(array_key_exists('relationships', $response));
    }

    /** @test */
    function it_creates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Relationships/create.json')),
        ]);

        $api = new Relationships(['mock' => $mock]);

        $response = $api->create('bqqjnwsuy', []);

        $this->assertNull($response);

        $response = $api->create('bqqjnwsuy', [
            'foreignKeyField' => [
                'label' => 'my relationship field'
            ],
        ]);

        $this->assertNull($response);

        $response = $api->create('bqqjnwsuy', [
            'parentTableId' => 'bck7gp3q2',
            'foreignKeyField' => [
                'label' => 'my relationship field'
            ],
            'lookupFieldIds' => [
                1,
                2,
                3,
            ],
            'summaryFields' => [
                [
                    'summaryFid' => 3,
                    'label' => 'my first summary field',
                    'accumulationType' => 'AVG',
                    'where' => "{'3'.EX.1}",
                ],
                [
                    'summaryFid' => 4,
                    'label' => 'my second summary field',
                    'accumulationType' => 'SUM'
                ],
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('foreignKeyField', $response));
        $this->assertTrue(array_key_exists('lookupFields', $response));
        $this->assertTrue(array_key_exists('isCrossApp', $response));
        $this->assertTrue(array_key_exists('parentTableId', $response));
        $this->assertTrue(array_key_exists('childTableId', $response));
        $this->assertTrue(array_key_exists('summaryFields', $response));
    }

    /** @test */
    function it_updates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Relationships/update.json')),
        ]);

        $api = new Relationships(['mock' => $mock]);

        $response = $api->update('bqqjnwsuy', []);

        $this->assertNull($response);

        $response = $api->update('bqqjnwsuy', 6, [
            'lookupFieldIds' => [
                4,
                5,
                6,
            ],
            'summaryFields' => [
                [
                    'summaryFid' => 3,
                    'label' => 'my summary field',
                    'accumulationType' => 'COUNT',
                    'where' => "{'3'.EX.1}"
                ],
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('foreignKeyField', $response));
        $this->assertTrue(array_key_exists('lookupFields', $response));
        $this->assertTrue(array_key_exists('isCrossApp', $response));
        $this->assertTrue(array_key_exists('parentTableId', $response));
        $this->assertTrue(array_key_exists('childTableId', $response));
        $this->assertTrue(array_key_exists('summaryFields', $response));
    }

        /** @test */
    function it_deletes_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Relationships/delete.json')),
        ]);

        $apps = new Relationships(['mock' => $mock]);

        $response = $apps->delete('bqqjnwsuy', 6);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('relationshipId', $response));
    }
}
