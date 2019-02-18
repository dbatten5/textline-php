<?php

namespace Textline\Http;

interface Client
{
    public function post(string $url, array $body = [], array $headers = []);

    public function get(string $url, array $body = [], array $headers = []);

    public function setHeaders(array $headers);
}
