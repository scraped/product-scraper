<?php

namespace Stunami\Scraper\Pimple;

use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Stunami\Scraper\Fetcher\HttpFetcher;
use Stunami\Scraper\Http\Psr7Client;
use Stunami\Scraper\Parser\CategoryParser;
use Stunami\Scraper\Parser\ProductParser;
use Stunami\Scraper\Scraper;
use Stunami\Scraper\Transformer\ByteToSizeTransformer;
use Stunami\Scraper\Transformer\PriceToDecimalTransformer;

final class ScraperProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        /**
         * @param $c
         * @return Scraper
         */
        $container['scraper'] = function ($c) {
            return new Scraper(
                $c['http.url.fetcher'],
                $c['category.parser'],
                $c['product.parser'],
                $c['byte_to_size.transformer']
            );
        };

        $container['psr7.client'] = function ($c) {
            return new Psr7Client(new Client());
        };

        $container['http.url.fetcher'] = function ($c) {
            return new HttpFetcher($c['psr7.client']);
        };

        $container['product.parser'] = function ($c) {
            return new ProductParser($c['crawler.factory'], $c['price_to_decimal.transformer']);
        };

        $container['category.parser'] = function ($c) {
            return new CategoryParser($c['crawler.factory']);
        };

        $container['byte_to_size.transformer'] = function ($c) {
            return new ByteToSizeTransformer(2);
        };

        $container['price_to_decimal.transformer'] = function ($c) {
            return new PriceToDecimalTransformer();
        };
    }

}