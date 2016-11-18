<?php

namespace Stunami\Scraper\Fetcher;

/**
 * Interface FetcherInterface
 *
 * Simple interface for Fetchers
 *
 * @package Stunami\Scraper\Fetcher
 */
interface FetcherInterface
{
    /**
     * @param $uri
     * @return mixed
     */
    public function fetch($uri);

    /**
     * @param array $uri
     * @return mixed
     */
    public function multiFetch(array $uri);
}