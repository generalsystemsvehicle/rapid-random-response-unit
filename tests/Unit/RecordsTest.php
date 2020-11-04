<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Api\Records;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class RecordsTest extends TestCase
{
    /** @test */
    function it_returns_a_paginated_index()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Records/index.json')),
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Records/index.json')),
        ]);

        $api = new Records(['mock' => $mock]);

        $response = $api->query([]);

        $this->assertNull($response);

        $response = $api->index([]);

        $this->assertNull($response);

        $response = $api->query([
            'from' => 'bck7gp3q2',
            'select' => [
                1,
                2,
                3,
            ],
            'where' => "{1.CT.'hello'}",
            "sortBy" => [
                [
                    "fieldId" => 4,
                    "order" => "ASC",
                ],
                [
                    "fieldId" => 5,
                    "order" => "ASC",
                ]
            ],
            "groupBy" => [
                [
                    "fieldId" => 6,
                    "grouping" => "equal-values",
                ]
            ],
            "options" => [
                "skip" => 0,
                "top" => 0,
                "compareWithAppLocalTime" => false,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('data', $response));
        $this->assertTrue(array_key_exists('fields', $response));
        $this->assertTrue(array_key_exists('metadata', $response));

        $response = $api->index([
            'from' => 'bck7gp3q2',
            'select' => [
                1,
                2,
                3,
            ],
            'where' => "{1.CT.'hello'}",
            "sortBy" => [
                [
                    "fieldId" => 4,
                    "order" => "ASC",
                ],
                [
                    "fieldId" => 5,
                    "order" => "ASC",
                ]
            ],
            "groupBy" => [
                [
                    "fieldId" => 6,
                    "grouping" => "equal-values",
                ]
            ],
            "options" => [
                "skip" => 0,
                "top" => 0,
                "compareWithAppLocalTime" => false,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('data', $response));
        $this->assertTrue(array_key_exists('fields', $response));
        $this->assertTrue(array_key_exists('metadata', $response));
    }

    /** @test */
    function it_upserts_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Records/upsert.json')),
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Records/upsert.json')),
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Records/upsert.json')),
        ]);

        $api = new Records(['mock' => $mock]);

        $response = $api->create([]);

        $this->assertNull($response);

        $response = $api->update([]);

        $this->assertNull($response);

        $response = $api->upsert([]);

        $this->assertNull($response);

        $response = $api->create([
            'data' => [],
        ]);

        $this->assertNull($response);

        $response = $api->update([
            'data' => [],
        ]);

        $this->assertNull($response);

        $response = $api->upsert([
            'data' => [],
        ]);

        $this->assertNull($response);

        $response = $api->create([
            'to' => 'bck7gp3q2',
            'data' => [
                [
                    '6' => [
                        'value' => 'This is my text',
                    ],
                    '7' => [
                        'value' => 10,
                    ],
                    '8' => [
                        'value' => '2019-12-18T08:00:00.000Z',
                    ],
                    '9' => [
                        'value' => [
                            'a',
                            'b'
                        ],
                    ],
                    '10' => [
                        'value' => true,
                    ],
                    '11' => [
                        'value' => 'user@quickbase.com',
                    ],
                    '12' => [
                        'value' => 'www.quickbase.com',
                    ],
                    '13' => [
                        'value' => [
                            [
                                'id' => '123456.ab1s',
                            ],
                            [
                                'id' => '254789.mkgp',
                            ],
                            [
                                'id' => '789654.vc2s',
                            ],
                        ],
                    ],
                ],
            ],
            'fieldsToReturn' => [
                6,
                7,
                8,
                9,
                10,
                11,
                12,
                13,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('data', $response));
        $this->assertTrue(array_key_exists('metadata', $response));

        $response = $api->update([
            'to' => 'bck7gp3q2',
            'data' => [
                [
                    '6' => [
                        'value' => 'This is my text',
                    ],
                    '7' => [
                        'value' => 10,
                    ],
                    '8' => [
                        'value' => '2019-12-18T08:00:00.000Z',
                    ],
                    '9' => [
                        'value' => [
                            'a',
                            'b'
                        ],
                    ],
                    '10' => [
                        'value' => true,
                    ],
                    '11' => [
                        'value' => 'user@quickbase.com',
                    ],
                    '12' => [
                        'value' => 'www.quickbase.com',
                    ],
                    '13' => [
                        'value' => [
                            [
                                'id' => '123456.ab1s',
                            ],
                            [
                                'id' => '254789.mkgp',
                            ],
                            [
                                'id' => '789654.vc2s',
                            ],
                        ],
                    ],
                ],
            ],
            'fieldsToReturn' => [
                6,
                7,
                8,
                9,
                10,
                11,
                12,
                13,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('data', $response));
        $this->assertTrue(array_key_exists('metadata', $response));

        $response = $api->upsert([
            'to' => 'bck7gp3q2',
            'data' => [
                [
                    '6' => [
                        'value' => 'This is my text',
                    ],
                    '7' => [
                        'value' => 10,
                    ],
                    '8' => [
                        'value' => '2019-12-18T08:00:00.000Z',
                    ],
                    '9' => [
                        'value' => [
                            'a',
                            'b'
                        ],
                    ],
                    '10' => [
                        'value' => true,
                    ],
                    '11' => [
                        'value' => 'user@quickbase.com',
                    ],
                    '12' => [
                        'value' => 'www.quickbase.com',
                    ],
                    '13' => [
                        'value' => [
                            [
                                'id' => '123456.ab1s',
                            ],
                            [
                                'id' => '254789.mkgp',
                            ],
                            [
                                'id' => '789654.vc2s',
                            ],
                        ],
                    ],
                ],
            ],
            'fieldsToReturn' => [
                6,
                7,
                8,
                9,
                10,
                11,
                12,
                13,
            ],
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('data', $response));
        $this->assertTrue(array_key_exists('metadata', $response));
    }

    /** @test */
    function it_deletes_a_record()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], file_get_contents(__DIR__.'/../Fixtures/Records/delete.json')),
        ]);

        $api = new Records(['mock' => $mock]);

        $response = $api->delete([]);

        $this->assertNull($response);

        $response = $api->delete([
            'from' => 'bck7gp3q2',
        ]);

        $this->assertNull($response);

        $response = $api->delete([
            'where' => "{6.EX.'hello'}",
        ]);

        $this->assertNull($response);

        $response = $api->delete([
            'from' => 'bck7gp3q2',
            'where' => "{6.EX.'hello'}",
        ]);

        $this->assertTrue(is_array($response));
        $this->assertTrue(array_key_exists('numberDeleted', $response));
    }
}
