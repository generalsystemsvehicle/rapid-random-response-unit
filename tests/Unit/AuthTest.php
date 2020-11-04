<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Auth;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class AuthTest extends TestCase
{
    /** @test */
    function it_gets_a_temporary_token()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Auth/temporaryToken.json')),
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Auth/temporaryToken.json')),
        ]);

        $auth = new Auth(['mock' => $mock]);

        $response = $auth->get('bpqe82s1');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('temporaryAuthorization', $response));

        $response = $auth->temporaryToken('bpqe82s1');

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('temporaryAuthorization', $response));
    }
}
