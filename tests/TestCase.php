<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response as Psr7Response;

abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function getMockClient($status, $body = null)
    {
        $mock = new MockHandler([new Psr7Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return $client;
    }
}
