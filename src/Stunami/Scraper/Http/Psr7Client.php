<?php

namespace Stunami\Scraper\Http;

use GuzzleHttp\Promise;
use GuzzleHttp\Client;

/**
 * Class Psr7Client
 *
 * Simple wrapper for PSR Client
 *
 * @package Stunami\Scraper\Http
 */
final class Psr7Client implements ClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * GuzzleClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $url
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($url)
    {
        return $this->client->request('GET', $url);
    }

    /**
     * @param array $urls
     * @return array
     */
    public function getAsnyc(array $urls)
    {
        $promises = [];
        foreach( $urls as $url) {
            $promises[] = $this->client->requestAsync('GET', $url);
        }

        return Promise\unwrap($promises);
    }

}