<?php

namespace Stunami\Scraper\Parser;

use Stunami\Scraper\Crawler\CrawlerFactory;
use Stunami\Scraper\Model\Category;

/**
 * Class CategoryParser
 * @package Stunami\Scraper\Parser
 */
final class CategoryParser
{
    /**
     * @var CrawlerFactory
     */
    private $crawlerFactory;

    /**
     * ProductParser constructor.
     *
     * @param Crawler $crawler
     */
    public function __construct(CrawlerFactory $crawlerFactory)
    {
        $this->crawlerFactory = $crawlerFactory;
    }

    /**
     * Parses HTML and returns a Category
     *
     * @param $html
     * @return Category
     */
    public function parse($html)
    {
        $crawler = $this->crawlerFactory->create($html);

        $productLinks = $crawler->filterXPath("//div[@class='productInfo']/h3/a");

        $category = new Category();

        foreach ($productLinks as $link) {
            $category->addLink(trim($link->getAttribute('href')));
        }

        return $category;
    }
}