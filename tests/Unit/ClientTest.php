<?php

namespace Tests;

use Textline\Client;
use Textline\Http\Client as HttpClient;
use Textline\Http\Response;
use Textline\Resources\Conversations;

class ClientTest extends TestCase
{
    /** @test */
    public function it_will_set_the_api_credentials()
    {
        $email = 'a';
        $password = 'b';
        $key = 'c';
        $token = 'd';
        $clientMock = $this->mock(HttpClient::class);

        $clientMock
            ->shouldReceive('setHeader')
            ->once()
            ->with('X-TGP-ACCESS-TOKEN', $token)
            ->andReturn(true);

        $client = new Client($email, $password, $key, $token, [], $clientMock);

        $this->assertEquals($client->getEmail(), $email);
        $this->assertEquals($client->getPassword(), $password);
        $this->assertEquals($client->getApiKey(), $key);
    }

    /** @test */
    public function it_will_hit_the_auth_endpoint_if_no_token_passed_in()
    {
        $email = 'a';
        $password = 'b';
        $key = 'c';
        $clientMock = $this->mock(HttpClient::class);

        $responseMock = $this->mock(Response::class);
        $responseObject = new \stdClass;
        $responseObject->access_token = new \stdClass;
        $responseObject->access_token->token = 'token';
        $responseMock
            ->shouldReceive('getContent')
            ->once()
            ->andReturn($responseObject);

        $clientMock
            ->shouldReceive('post')
            ->once()
            ->with('auth/sign_in.json', [
                'user' => [
                    'email' => $email,
                    'password' => $password,
                ],
                'api_key' => $key
            ])
            ->andReturn($responseMock);

        $clientMock
            ->shouldReceive('setHeader')
            ->once()
            ->with('X-TGP-ACCESS-TOKEN', 'token')
            ->andReturn(true);

        $client = new Client($email, $password, $key, null, [], $clientMock);

        $this->assertEquals($client->getToken(), 'token');
    }

    /** @test */
    public function it_can_return_a_conversations_resource()
    {
        $email = 'a';
        $password = 'b';
        $key = 'c';
        $token = 'd';
        $clientMock = $this->mock(HttpClient::class);

        $clientMock->shouldReceive('setHeader');

        $client = new Client($email, $password, $key, $token, [], $clientMock);

        $this->assertInstanceOf(Conversations::class, $client->conversations());
    }
}
