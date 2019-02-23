<?php

namespace Textline\Resources;

class Conversation extends Resource
{
    public function retrieve(string $id, array $query = [])
    {
        $response = $this->client
                         ->get("conversation/{$id}.json", $query)
                         ->getContent();

        return $response;
    }

    public function message(string $id, array $body = [])
    {
        $response = $this->client
                         ->post("conversation/{$id}.json", $body)
                         ->getContent();

        return $response;
    }

    public function scheduleMessage(string $id, int $timestamp, string $body)
    {
        $response = $this->client
                         ->post("conversation/{$id}/schedule.json", [
                             'timestamp' => $timestamp,
                             'comment' => [
                                 'body' => $body
                             ]
                         ])
                         ->getContent();

        return $response;
    }
}
