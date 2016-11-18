<?php

namespace Stunami\Scraper\Crawler;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class CrawlerFactory
 *
 * Factory for Crawler
 *
 * @package Stunami\Scraper\Crawler
 */
final class CrawlerFactory
{
    public function create($html)
    {
        return new Crawler($html);
    }
}
