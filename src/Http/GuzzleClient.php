<?php

namespace Textline\Http;

use GuzzleHttp\Client as GuzzleBaseClient;

class GuzzleClient implements Client
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(GuzzleBaseClient $client)
    {
        $this->client = $client;
    }

    /**
     * Make a request
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @author Dom Batten <db@mettrr.com>
     */
    public function request(string $method, string $url, array $body = [])
    {
        $method = strtoupper($method);

        switch ($method) {
            case 'GET':
            case 'PUT':
            case 'POST':
            case 'DELETE':
                break;
            default:
                throw new \Exception("Method {$method} not recognised");
                break;
        }

        $res = $this->client->request($method, $url, $body);

        return new Response(
            $res->getStatusCode(),
            $res->getBody()
        );
    }
}
