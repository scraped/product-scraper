<?php

namespace Stunami\Scraper\Fetcher;

use Psr\Http\Message\ResponseInterface;
use Stunami\Scraper\Http\ClientInterface;
use Stunami\Scraper\Http\Psr7Client;

final class HttpFetcher implements FetcherInterface
{
    /**
     * @var Psr7Client
     */
    private $client;

    /**
     * HttpFetcher constructor.
     * @param Psr7Client $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $uri
     * @return ResponseInterface
     */
    public function fetch($uri)
    {
        return $this->client->get($uri);
    }

    /**
     * @param array $uri
     * @return ResponseInterface[]
     */
    public function multiFetch(array $uri)
    {
        return $this->client->getAsnyc($uri);
    }
}