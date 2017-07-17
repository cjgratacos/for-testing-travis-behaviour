<?php

namespace BackupTool\Service\Repo\REST;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class RestClient
{
    private $client;

    function __construct()
    {
        $this->client = new Client();
    }

    public function get(string $uri, array $header = []):ResponseInterface {

        return $this->client->get($uri, $header);
    }

    public function post(string $uri, array $header = [], array $body = []):ResponseInterface {
        return $this->client->post($uri, array_merge($header, $body));
    }

    public function put(string $uri, array $header = [], array $body = []):ResponseInterface {
        return $this->client->put($uri, array_merge($header, $body));
    }
}