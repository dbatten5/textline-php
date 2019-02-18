<?php

namespace Textline\Http;

use GuzzleHttp\Client as GuzzleBaseClient;

class GuzzleClient implements Client
{
    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var array
     */
    protected $headers;

    public function __construct(string $baseUri, array $headers = [])
    {
        $this->baseUri = $baseUri;
        $this->headers = $headers;

        $this->client = new GuzzleBaseClient([
            'base_uri' => $this->baseUri,
            'headers' => $this->headers,
        ]);
    }

    /**
     * Make a request
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @author Dom Batten <db@mettrr.com>
     */
    private function request(string $method, string $url, array $body = [], array $headers = [])
    {
        $res = $this->client->request(strtoupper($method), $url, [
            'json' => $body,
            'headers' => array_merge($this->headers, $headers),
        ]);

        return new Response(
            $res->getStatusCode(),
            $res->getBody()
        );
    }

    public function post(string $url, array $body = [], array $headers = [])
    {
        return $this->request('post', $url, $body, $headers);
    }

    public function get(string $url, array $body = [], array $headers = [])
    {
        return $this->request('get', $url, $body, $headers);
    }

    public function setHeaders(array $headers)
    {
        return $this->headers = array_merge_recursive($this->headers, $headers);
    }
}
