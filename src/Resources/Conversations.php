<?php

namespace Textline\Resources;

use Textline\Http\Request;

class Conversations
{
    /**
     * @var Request $request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function list(array $params = [])
    {
        $response = $this->request->curl->get('conversations.json')->getContent();

        return $response;
    }

    public function retrieve(string $id, $params = [])
    {
        $response = $this->request->curl->get("conversation/{$id}.json")->getContent();
        return $response;
    }
}
