<?php

namespace Stunami\Scraper\Tests;

use Stunami\Scraper\Crawler\CrawlerFactory;
use Stunami\Scraper\Fetcher\LocalFetcher;
use Stunami\Scraper\Model\Product;
use Stunami\Scraper\Model\Summary;
use Stunami\Scraper\Parser\CategoryParser;
use Stunami\Scraper\Parser\ProductParser;
use Stunami\Scraper\Scraper;
use Stunami\Scraper\Transformer\ByteToSizeTransformer;
use Stunami\Scraper\Transformer\PriceToDecimalTransformer;

/**
 * Class ScraperTest
 * @package Stunami\Scraper\Tests
 */
class ScraperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test scrape method
     */
    public function testScrape()
    {
        $crawlerFactory = new CrawlerFactory();

        $scraper = new Scraper(
            new LocalFetcher(__DIR__.'/Fixtures/'),
            new CategoryParser($crawlerFactory),
            new ProductParser($crawlerFactory, new PriceToDecimalTransformer()),
            new ByteToSizeTransformer()
        );

        $summary = $scraper->scrape('products.html');

        $this->assertInstanceOf(Summary::class, $summary);
        $this->assertCount(7, $summary->getResults());
        $this->assertInstanceOf(Product::class, $summary->getResults()[0]);
        $this->assertEquals('Sainsbury\'s Apricot Ripe & Ready x5', $summary->getResults()[0]->getTitle());
        $this->assertEquals(15.1, $summary->getTotal());
    }
}
