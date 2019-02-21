<?php

namespace Textline\Resources;

use Textline\Http\Client as HttpClient;

class Conversations
{
    /**
     * @var HttpClient $client
     */
    protected $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function list(array $query = [])
    {
        $response = $this->client->get('conversations.json', $query)->getContent();

        return $response;
    }

    public function retrieve(string $id, array $query = [])
    {
        $response = $this->client->get("conversation/{$id}.json", $query)->getContent();

        return $response;
    }

    public function message(string $id, array $query = [])
    {
        $response = $this->client->post("conversation/{$id}.json", $query)->getContent();

        return $response;
    }
}
