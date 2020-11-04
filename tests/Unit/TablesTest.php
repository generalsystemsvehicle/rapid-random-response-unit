<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Tables;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class TablesTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Tables/index.json')),
        ]);

        $api = new Tables(['mock' => $mock]);

        $response = $api->index('bpqe82s1');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('name', $response[0]));
        $this->assertTrue(array_key_exists('created', $response[0]));
        $this->assertTrue(array_key_exists('updated', $response[0]));
        $this->assertTrue(array_key_exists('alias', $response[0]));
        $this->assertTrue(array_key_exists('description', $response[0]));
        $this->assertTrue(array_key_exists('id', $response[0]));
        $this->assertTrue(array_key_exists('nextRecordId', $response[0]));
        $this->assertTrue(array_key_exists('nextFieldId', $response[0]));
        $this->assertTrue(array_key_exists('defaultSortFieldId', $response[0]));
        $this->assertTrue(array_key_exists('defaultSortOrder', $response[0]));
        $this->assertTrue(array_key_exists('keyFieldId', $response[0]));
        $this->assertTrue(array_key_exists('singleRecordName', $response[0]));
        $this->assertTrue(array_key_exists('pluralRecordName', $response[0]));
        $this->assertTrue(array_key_exists('sizeLimit', $response[0]));
        $this->assertTrue(array_key_exists('spaceUsed', $response[0]));
        $this->assertTrue(array_key_exists('spaceRemaining', $response[0]));
    }

    /** @test */
    function it_gets_a_single_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Tables/get.json')),
        ]);

        $api = new Tables(['mock' => $mock]);

        $response = $api->get('bpqe82s1', 'bpqe82s0');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('updated', $response));
        $this->assertTrue(array_key_exists('alias', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('nextRecordId', $response));
        $this->assertTrue(array_key_exists('nextFieldId', $response));
        $this->assertTrue(array_key_exists('defaultSortFieldId', $response));
        $this->assertTrue(array_key_exists('defaultSortOrder', $response));
        $this->assertTrue(array_key_exists('keyFieldId', $response));
        $this->assertTrue(array_key_exists('singleRecordName', $response));
        $this->assertTrue(array_key_exists('pluralRecordName', $response));
        $this->assertTrue(array_key_exists('sizeLimit', $response));
        $this->assertTrue(array_key_exists('spaceUsed', $response));
        $this->assertTrue(array_key_exists('spaceRemaining', $response));
    }

    /** @test */
    function it_creates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Tables/create.json')),
        ]);

        $api = new Tables(['mock' => $mock]);

        $response = $api->create('bpqe82s1', []);

        $this->assertNull($response);

        $response = $api->create('bpqe82s1', [
            'description' => 'Table as an example.',
        ]);

        $this->assertNull($response);

        $response = $api->create('bpqe82s1', [
            'name' => 'Example Table',
            'description' => 'Table as an example.',
            'singleRecordName' => 'Example Record',
            'pluralRecordName' => 'Example Records',
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('updated', $response));
        $this->assertTrue(array_key_exists('alias', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('nextRecordId', $response));
        $this->assertTrue(array_key_exists('nextFieldId', $response));
        $this->assertTrue(array_key_exists('defaultSortFieldId', $response));
        $this->assertTrue(array_key_exists('defaultSortOrder', $response));
        $this->assertTrue(array_key_exists('keyFieldId', $response));
        $this->assertTrue(array_key_exists('singleRecordName', $response));
        $this->assertTrue(array_key_exists('pluralRecordName', $response));
        $this->assertTrue(array_key_exists('sizeLimit', $response));
        $this->assertTrue(array_key_exists('spaceUsed', $response));
        $this->assertTrue(array_key_exists('spaceRemaining', $response));
    }

    /** @test */
    function it_updates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Tables/update.json')),
        ]);

        $api = new Tables(['mock' => $mock]);

        $response = $api->update('bpqe82s1', 'bpqe82s0', []);

        $this->assertNull($response);

        $response = $api->update('bpqe82s1', 'bpqe82s0', [
            'name' => 'Example Table',
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('updated', $response));
        $this->assertTrue(array_key_exists('alias', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('nextRecordId', $response));
        $this->assertTrue(array_key_exists('nextFieldId', $response));
        $this->assertTrue(array_key_exists('defaultSortFieldId', $response));
        $this->assertTrue(array_key_exists('defaultSortOrder', $response));
        $this->assertTrue(array_key_exists('keyFieldId', $response));
        $this->assertTrue(array_key_exists('singleRecordName', $response));
        $this->assertTrue(array_key_exists('pluralRecordName', $response));
        $this->assertTrue(array_key_exists('sizeLimit', $response));
        $this->assertTrue(array_key_exists('spaceUsed', $response));
        $this->assertTrue(array_key_exists('spaceRemaining', $response));
    }

    /** @test */
    function it_deletes_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Tables/delete.json')),
        ]);

        $api = new Tables(['mock' => $mock]);

        $response = $api->delete('bpqe82s1', 'bck7gp3q2');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('deletedTableId', $response));
    }
}
