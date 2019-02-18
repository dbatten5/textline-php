<?php

namespace Textline;

use Textline\Http\Request;
use Textline\Resources\Conversations;

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

    public function __construct(string $email, string $password, string $apiKey)
    {
        $this->email = $email;
        $this->password = $password;
        $this->apiKey = $apiKey;

        $this->request = new Request();
        $this->auth();
    }

    public function auth()
    {
        $response = $this->request->curl->post('auth/sign_in.json', [
            'user' => [
                'email' => $this->email,
                'password' => $this->password,
            ],
            'api_key' => $this->apiKey
        ]);

        $this->token = $response->getContent()->access_token->token;

        $this->request = new Request($this->token);
    }

    public function conversations()
    {
        return new Conversations($this->request);
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
}
