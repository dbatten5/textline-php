<?php

namespace Textline\Resources;

class Conversations extends Resource
{
    public function list(array $query = [])
    {
        $response = $this->client
                         ->get('conversations.json', $query)
                         ->getContent();

        return $response;
    }
}
