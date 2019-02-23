<?php

namespace Textline;

use Textline\Http\Client as HttpClient;
use Textline\Resources\Conversations;
use Textline\Resources\Conversation;
use Textline\Http\GuzzleClient;

class Client
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUri = 'https://application.textline.com/';

    public function __construct(string $email, string $password, string $apiKey, string $token = null, array $headers = [], HttpClient $client = null, array $clientConfig = [])
    {
        $this->email = $email;
        $this->password = $password;
        $this->apiKey = $apiKey;
        $this->token = $token;
        $this->headers = $headers;
        $this->client = $client ?? new GuzzleClient($this->baseUri, $this->headers, $clientConfig);

        $token ? $this->client->setAuth($this->token) : $this->auth();
    }

    public function auth()
    {
        $response = $this->client->post('auth/sign_in.json', [
            'user' => [
                'email' => $this->email,
                'password' => $this->password,
            ],
            'api_key' => $this->apiKey
        ]);

        $this->token = $response->getContent()->access_token->token;

        $this->client->setAuth($this->token);

        return $this;
    }

    public function conversations()
    {
        return new Conversations($this->client);
    }

    public function conversation()
    {
        return new Conversation($this->client);
    }

    /**
     * Getter for email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Getter for password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Getter for apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
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
}
