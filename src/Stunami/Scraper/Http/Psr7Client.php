<?php

namespace Stunami\Scraper\Http;

use GuzzleHttp\Promise;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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
     * Makes a GET request
     *
     * @param $url
     * @return ResponseInterface
     */
    public function get($url)
    {
        return $this->client->request('GET', $url);
    }

    /**
     * Makes multiple concurrent
     *
     * @param array $urls
     * @return array
     */
    public function getConcurrent(array $urls)
    {
        $promises = [];
        foreach( $urls as $url) {
            $promises[] = $this->client->requestAsync('GET', $url);
        }

        return Promise\unwrap($promises);
    }

}