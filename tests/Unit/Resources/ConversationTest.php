<?php

namespace Tests;

use Textline\Resources\Conversation;
use Textline\Http\Client;
use Textline\Http\Response;

class ConversationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->client = $this->mock(Client::class);
        $this->conversation = new Conversation($this->client);
        $this->response = $this->mock(Response::class);
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

        $this->assertTrue($this->conversation->retrieve('1', ['foo' => 'bar']));
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

        $this->assertTrue($this->conversation->message('1', ['foo' => 'bar']));
    }

    /** @test */
    public function it_can_schedule_a_message_to_a_conversation()
    {
        $id = '123';
        $time = 456;
        $body = 'foo';

        $this->client
            ->shouldReceive('post')
            ->once()
            ->with('conversation/123/schedule.json', [
                'timestamp' => 456,
                'comment' => [
                    'body' => 'foo'
                ]
            ])
            ->andReturn($this->response);

        $this->response
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(true);

        $this->assertTrue($this->conversation->scheduleMessage($id, $time, $body));
    }
}
