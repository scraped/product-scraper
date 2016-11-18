<?php

namespace Stunami\Scraper\Parser;

use Stunami\Scraper\Crawler\CrawlerFactory;
use Stunami\Scraper\Model\Product;
use Stunami\Scraper\Transformer\PriceToDecimalTransformer;

/**
 * Class ProductParser
 *
 * Simple HTML parser for Product page
 *
 * @package Stunami\Scraper\Parser
 */
final class ProductParser
{
    /**
     * @var CrawlerFactory
     */
    private $crawlerFactory;

    /**
     * @var PriceToDecimalTransformer
     */
    private $priceToDecimalTransformer;

    /**
     * ProductParser constructor.
     *
     * @param CrawlerFactory $crawlerFactory
     * @param PriceToDecimalTransformer $priceToDecimalTransformer
     * @internal param Crawler $crawler
     */
    public function __construct(CrawlerFactory $crawlerFactory, PriceToDecimalTransformer $priceToDecimalTransformer)
    {
        $this->crawlerFactory = $crawlerFactory;
        $this->priceToDecimalTransformer = $priceToDecimalTransformer;
    }

    /**
     * Parses HTML for Product information and returns Product
     *
     * @param $html
     * @return Product
     */
    public function parse($html)
    {
        $crawler = $this->crawlerFactory->create($html);

        $title = $crawler->filterXPath("//div[@class='productTitleDescriptionContainer']")->first();
        $size = $crawler->filterXPath("//p[@class='pricePerUnit']")->first();
        $description = $crawler->filterXPath("//div[@class='productText']")->first();

        $data = new Product();
        $data->setTitle(trim($title->text()));
        $data->setUnitPrice($this->priceToDecimalTransformer->transform($size->text()));
        $data->setDescription(trim($description->text()));

        return $data;
    }
}