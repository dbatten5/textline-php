<?php

namespace Textline\Resources;

class Customer extends Resource
{
    public function retrieve(string $id)
    {
        $response = $this->client
                         ->get("customer/{$id}.json")
                         ->getContent();

        return $response;
    }

    public function update(string $id, array $body = [])
    {
        $response = $this->client
                         ->put("customer/{$id}.json", $body)
                         ->getContent();

        return $response;
    }
}

