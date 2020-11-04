<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Apps;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class AppsTest extends TestCase
{
    /** @test */
    function it_gets_a_single_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Apps/get.json')),
        ]);

        $apps = new Apps(['mock' => $mock]);

        $response = $apps->get('bpqe82s1');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('dateFormat', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('hasEveryoneOnTheInternet', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('timeZone', $response));
        $this->assertTrue(array_key_exists('variables', $response));
        $this->assertTrue(array_key_exists('updated', $response));
    }

    /** @test */
    function it_creates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Apps/create.json')),
        ]);

        $apps = new Apps(['mock' => $mock]);

        $response = $apps->create([]);

        $this->assertNull($response);

        $response = $apps->create([
            'description' => 'My first app',
        ]);

        $this->assertNull($response);

        $response = $apps->create([
            'name' => 'My App',
            'description' => 'My first app',
            'assignToken' => true,
            'variables' => [
                [
                  'name' => 'Variable1',
                  'value' => 'Value1',
                ],
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('dateFormat', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('hasEveryoneOnTheInternet', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('timeZone', $response));
        $this->assertTrue(array_key_exists('variables', $response));
        $this->assertTrue(array_key_exists('updated', $response));
    }

    /** @test */
    function it_updates_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Apps/update.json')),
        ]);

        $apps = new Apps(['mock' => $mock]);

        $response = $apps->update([]);

        $this->assertNull($response);

        $response = $apps->update('bpqe82s1', [
            'name' => 'My App 2',
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('dateFormat', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('hasEveryoneOnTheInternet', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('timeZone', $response));
        $this->assertTrue(array_key_exists('variables', $response));
        $this->assertTrue(array_key_exists('updated', $response));
    }

    /** @test */
    function it_copies_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Apps/copy.json')),
        ]);

        $apps = new Apps(['mock' => $mock]);

        $response = $apps->copy('bqhskthaq', []);

        $this->assertNull($response);

        $response = $apps->copy('bqhskthaq', [
            'description' => 'copied from my original app',
        ]);

        $this->assertNull($response);

        $response = $apps->copy('bqhskthaq', [
            'name' => 'my copied app',
            'description' => 'copied from my original app',
            'properties' => [
                'keepData' =>  false,
                'excludeFiles' =>  true,
                'usersAndRoles' =>  false,
                'assignUserToken' =>  true,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('created', $response));
        $this->assertTrue(array_key_exists('dateFormat', $response));
        $this->assertTrue(array_key_exists('description', $response));
        $this->assertTrue(array_key_exists('hasEveryoneOnTheInternet', $response));
        $this->assertTrue(array_key_exists('id', $response));
        $this->assertTrue(array_key_exists('name', $response));
        $this->assertTrue(array_key_exists('timeZone', $response));
        $this->assertTrue(array_key_exists('updated', $response));
    }

    /** @test */
    function it_deletes_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Apps/delete.json')),
        ]);

        $apps = new Apps(['mock' => $mock]);

        $response = $apps->delete('bqhskthaq', []);

        $this->assertNull($response);

        $response = $apps->delete('bqhskthaq', [
            'name' => 'Name of an application to delete',
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('deletedAppId', $response));
    }
}
