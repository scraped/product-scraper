<?php

namespace Stunami\Scraper\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Stunami\Scraper\Crawler\CrawlerFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class DomCrawlerProvider
 *
 * Provider for symfony/dom-crawler
 *
 * @package Stunami\Scraper\Pimple
 */
final class DomCrawlerProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['crawler.factory'] = function ($c) {
            return new CrawlerFactory();
        };
    }
}