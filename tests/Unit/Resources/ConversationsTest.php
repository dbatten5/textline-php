<?php

namespace Tests;

use Textline\Resources\Conversations;
use Textline\Http\Client;
use Textline\Http\Response;

class ConversationsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->client = $this->mock(Client::class);
        $this->conversations = new Conversations($this->client);
        $this->response = $this->mock(Response::class);
    }

    /** @test */
    public function it_can_list_conversations()
    {
        $this->client
            ->shouldReceive('get')
            ->once()
            ->with('conversations.json', [
                'foo' => 'bar'
            ])
            ->andReturn($this->response);

        $this->response
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(true);

        $this->assertTrue($this->conversations->list(['foo' => 'bar']));
    }

    /** @test */
    public function it_can_retrieve_a_conversation()
    {
        $this->client
            ->shouldReceive('get')
            ->once()
            ->with('conversation/1.json', [
                'foo' => 'bar'
            ])
            ->andReturn($this->response);

        $this->response
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(true);

        $this->assertTrue($this->conversations->retrieve('1', ['foo' => 'bar']));
    }

    /** @test */
    public function it_can_message_a_conversation()
    {
        $this->client
            ->shouldReceive('post')
            ->once()
            ->with('conversation/1.json', [
                'foo' => 'bar'
            ])
            ->andReturn($this->response);

        $this->response
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(true);

        $this->assertTrue($this->conversations->message('1', ['foo' => 'bar']));
    }
}
