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

    public function list(array $params = [])
    {
        $response = $this->client->get('conversations.json')->getContent();

        return $response;
    }

    public function retrieve(string $id, array $params = [])
    {
        $response = $this->client->get("conversation/{$id}.json")->getContent();

        return $response;
    }
}
