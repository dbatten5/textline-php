<?php

namespace Textline\Tests\Http\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response as Psr7Response;
use PHPUnit\Framework\TestCase;
use Textline\Http\GuzzleClient;
use Textline\Http\Response;

class GuzzleClientTest extends TestCase
{
    /** @test */
    public function it_will_reject_invalid_method()
    {
        $client = $this->getClient(200);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Method HELLO not recognised');

        $response = $client->request('hello', 'www');
    }

    /** @test */
    public function it_can_make_a_request()
    {
        $resBody = ['a' => 'b'];
        $client = $this->getClient(200, json_encode($resBody));

        $response = $client->request('get', 'www');

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getContent(), $resBody);
    }

    private function getClient($status, $body = null)
    {
        $mock = new MockHandler([new Psr7Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return new GuzzleClient($client);
    }
}
