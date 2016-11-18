<?php

namespace Stunami\Scraper;

use Stunami\Scraper\Fetcher\FetcherInterface;
use Stunami\Scraper\Model\Summary;
use Stunami\Scraper\Parser\CategoryParser;
use Stunami\Scraper\Parser\ProductParser;
use Stunami\Scraper\Transformer\ByteToSizeTransformer;

/**
 * Class Scraper
 * @package Stunami\Scraper
 */
class Scraper
{
    /**
     * @var FetcherInterface
     */
    private $fetcher;

    /**
     * @var CategoryParser
     */
    private $categoryParser;

    /**
     * @var ProductParser
     */
    private $productParser;

    /**
     * @var ByteToSizeTransformer
     */
    private $byteToSizeTransformer;

    /**
     * Scraper constructor.
     * @param FetcherInterface $fetcher
     * @param CategoryParser $categoryParser
     * @param ProductParser $productParser
     * @param ByteToSizeTransformer $byteToSizeTransformer
     */
    public function __construct(FetcherInterface $fetcher, CategoryParser $categoryParser, ProductParser $productParser, ByteToSizeTransformer $byteToSizeTransformer)
    {
        $this->fetcher = $fetcher;
        $this->categoryParser = $categoryParser;
        $this->productParser = $productParser;
        $this->byteToSizeTransformer = $byteToSizeTransformer;
    }

    /**
     * Scrapes a Category page for Product information
     *
     * @param $url
     * @return Summary
     */
    public function scrape($url)
    {
        $response = $this->fetcher->fetch($url);

        $category = $this->categoryParser->parse((string)$response->getBody());

        $responses = $this->fetcher->multiFetch($category->getLinks());

        $summary = new Summary();

        $products = [];
        foreach ($responses as $response) {

            $product = $this->productParser->parse((string)$response->getBody());

            $contentLength = current($response->getHeader('Content-Length'));
            $product->setSize($this->byteToSizeTransformer->transform($contentLength));

            $products[] = $product;
        }

        $summary->setResults($products);

        return $summary;
    }


}