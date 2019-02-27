<?php

namespace Textline\Resources;

class Conversations extends Resource
{
    public function get(array $query = [])
    {
        $response = $this->client
                         ->get('conversations.json', $query)
                         ->getContent();

        return $response;
    }

    public function messageByPhone(array $body = [])
    {
        $response = $this->client
                         ->post('conversations.json', $body)
                         ->getContent();

        return $response;
    }

    public function scheduleByPhone(string $number, int $timestamp, string $body)
    {
        $response = $this->client
                         ->post("conversations/schedule.json", [
                             'phone_number' => $number,
                             'timestamp' => $timestamp,
                             'comment' => [
                                 'body' => $body
                             ]
                         ])
                         ->getContent();

        return $response;
    }
}
