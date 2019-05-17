<?php

namespace App\Services;

use GuzzleHttp\Client;

class Shortener
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Shortener constructor.
     *
     * @param $login
     * @param $password
     * @param $base_uri
     */
    public function __construct($login, $password, $base_uri)
    {
        $this->client = new Client([
            'base_uri' => $base_uri,
            'auth' => [
                $login,
                $password
            ],
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * Возвращает сокращенную ссылку
     *
     * @param string $url
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function short($url)
    {
        $response = $this->client->request('POST', 'shortener', [
            'json' => [
                'short_url' => $url,
            ]
        ]);
        $shortener = json_decode($response->getBody());
        return $shortener->short_full;
    }

    /**
     * @return Client
     */
    protected function getClient()
    {
        return $this->client;
    }
}
