<?php

namespace Textline\Resources;

class Customers extends Resource
{
    public function get(array $query = [])
    {
        $response = $this->client
                         ->get('customers.json', $query)
                         ->getContent();

        return $response;
    }

    public function create(string $number, $body = [])
    {
        $response = $this->client
                         ->post('customers.json', array_merge($body, [
                             'phone_number' => $number
                         ]))
                         ->getContent();

        return $response;
    }
}
