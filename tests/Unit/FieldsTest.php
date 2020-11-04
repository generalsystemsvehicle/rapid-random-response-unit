<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Fields;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class FieldsTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Fields/index.json')),
        ]);

        $api = new Fields(['mock' => $mock]);

        $response = $api->index('bpqe82s1', [
            'includeFieldPerms' => true,
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response[0]));
        $this->assertTrue(array_key_exists('label', $response[0]));
        $this->assertTrue(array_key_exists('fieldType', $response[0]));
        $this->assertTrue(array_key_exists('noWrap', $response[0]));
        $this->assertTrue(array_key_exists('bold', $response[0]));
        $this->assertTrue(array_key_exists('required', $response[0]));
        $this->assertTrue(array_key_exists('appearsByDefault', $response[0]));
        $this->assertTrue(array_key_exists('findEnabled', $response[0]));
        $this->assertTrue(array_key_exists('allowNewChoices', $response[0]));
        $this->assertTrue(array_key_exists('sortAsGiven', $response[0]));
        $this->assertTrue(array_key_exists('carryChoices', $response[0]));
        $this->assertTrue(array_key_exists('foreignKey', $response[0]));
        $this->assertTrue(array_key_exists('unique', $response[0]));
        $this->assertTrue(array_key_exists('doesDataCopy', $response[0]));
        $this->assertTrue(array_key_exists('fieldHelp', $response[0]));
        $this->assertTrue(array_key_exists('audited', $response[0]));
        $this->assertTrue(array_key_exists('numLines', $response[0]));
        $this->assertTrue(array_key_exists('maxLength', $response[0]));
        $this->assertTrue(array_key_exists('appendOnly', $response[0]));
        $this->assertTrue(array_key_exists('allowHTML', $response[0]));
        $this->assertTrue(array_key_exists('permissions', $response[0]));
    }

    /** @test */
    function it_gets_a_single_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Fields/get.json')),
        ]);

        $api = new Fields(['mock' => $mock]);

        $response = $api->get('bck7gp3q2', 123, [
            'includeFieldPerms' => true,
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('label', $response));
        $this->assertTrue(array_key_exists('fieldType', $response));
        $this->assertTrue(array_key_exists('mode', $response));
        $this->assertTrue(array_key_exists('noWrap', $response));
        $this->assertTrue(array_key_exists('bold', $response));
        $this->assertTrue(array_key_exists('required', $response));
        $this->assertTrue(array_key_exists('appearsByDefault', $response));
        $this->assertTrue(array_key_exists('findEnabled', $response));
        $this->assertTrue(array_key_exists('unique', $response));
        $this->assertTrue(array_key_exists('doesDataCopy', $response));
        $this->assertTrue(array_key_exists('fieldHelp', $response));
        $this->assertTrue(array_key_exists('audited', $response));
        $this->assertTrue(array_key_exists('properties', $response));
        $this->assertTrue(array_key_exists('permissions', $response));
    }

    /** @test */
    function it_creates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Fields/create.json')),
        ]);

        $api = new Fields(['mock' => $mock]);

        $response = $api->create('bck7gp3q2', []);

        $this->assertNull($response);

        $response = $api->create('bck7gp3q2', [
            'label' => 'Field1',
        ]);

        $this->assertNull($response);

        $response = $api->create('bck7gp3q2', [
            'label' => 'Field1',
            'fieldType' => 'text',
            'noWrap' => false,
            'bold' => false,
            'appearsByDefault' => false,
            'findEnabled' => false,
            'fieldHelp' => 'field help',
            'addToForms' => true,
            'properties' => [
                'maxLength' => 0,
                'appendOnly' => false,
                'sortAsGiven' => false,
            ],
            'permissions' => [
                [
                    'role' => 'Viewer',
                    'permissionType' => 'View',
                    'roleId' => 10,
                ],
                [
                    'role' => 'Participant',
                    'permissionType' => 'None',
                    'roleId' => 11,
                ],
                [
                    'role' => 'Administrator',
                    'permissionType' => 'Modify',
                    'roleId' => 12,
                ],
            ]
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('label', $response));
        $this->assertTrue(array_key_exists('fieldType', $response));
        $this->assertTrue(array_key_exists('mode', $response));
        $this->assertTrue(array_key_exists('noWrap', $response));
        $this->assertTrue(array_key_exists('bold', $response));
        $this->assertTrue(array_key_exists('required', $response));
        $this->assertTrue(array_key_exists('appearsByDefault', $response));
        $this->assertTrue(array_key_exists('findEnabled', $response));
        $this->assertTrue(array_key_exists('unique', $response));
        $this->assertTrue(array_key_exists('doesDataCopy', $response));
        $this->assertTrue(array_key_exists('fieldHelp', $response));
        $this->assertTrue(array_key_exists('audited', $response));
        $this->assertTrue(array_key_exists('properties', $response));
        $this->assertTrue(array_key_exists('permissions', $response));
    }

    /** @test */
    function it_updates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Fields/update.json')),
        ]);

        $api = new Fields(['mock' => $mock]);

        $response = $api->update('bck7gp3q2', 123, []);

        $this->assertNull($response);

        $response = $api->update('bck7gp3q2', 123, [
            'label' => 'Field1',
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('label', $response));
        $this->assertTrue(array_key_exists('fieldType', $response));
        $this->assertTrue(array_key_exists('mode', $response));
        $this->assertTrue(array_key_exists('noWrap', $response));
        $this->assertTrue(array_key_exists('bold', $response));
        $this->assertTrue(array_key_exists('required', $response));
        $this->assertTrue(array_key_exists('appearsByDefault', $response));
        $this->assertTrue(array_key_exists('findEnabled', $response));
        $this->assertTrue(array_key_exists('unique', $response));
        $this->assertTrue(array_key_exists('doesDataCopy', $response));
        $this->assertTrue(array_key_exists('fieldHelp', $response));
        $this->assertTrue(array_key_exists('audited', $response));
        $this->assertTrue(array_key_exists('properties', $response));
        $this->assertTrue(array_key_exists('permissions', $response));
    }

    /** @test */
    function it_deletes_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Fields/delete.json')),
        ]);

        $api = new Fields(['mock' => $mock]);

        $response = $api->delete('bck7gp3q2', []);

        $this->assertNull($response);

        $response = $api->delete('bck7gp3q2', [
            'fieldIds' => [
                6,
                7,
                8,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('deletedFieldIds', $response));
        $this->assertTrue(array_key_exists('errors', $response));
    }
}
