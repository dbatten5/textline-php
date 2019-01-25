<?php

namespace Textline\Http;

interface Client
{
    public function request(string $method, string $url, array $body = []);
}
