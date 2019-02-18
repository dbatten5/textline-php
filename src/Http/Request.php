<?php

namespace Textline\Http;

use Textline\Http\Client;
use Textline\Http\GuzzleClient;

class Request
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var Client;
     */
    public $curl;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $baseUri = 'https://application.textline.com/';

    public function __construct(string $token = null, array $headers = [], Client $curl = null)
    {
        $this->token = $token;
        $this->headers = $headers;
        $this->curl = $curl ?? new GuzzleClient($this->baseUri);

        if (!is_null($token)) {
            $this->headers['X-TGP-ACCESS-TOKEN'] = $token;
        }

        $this->curl->setHeaders($this->headers);
    }

    /**
     * Getter for token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Getter for baseUri
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Getter for headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Getter for curl
     *
     * @return string
     */
    public function getCurl()
    {
        return $this->curl;
    }
}
