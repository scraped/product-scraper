<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 18:34
 */

namespace Stunami\Scraper\Tests\Parser;

use Stunami\Scraper\Crawler\CrawlerFactory;
use Stunami\Scraper\Model\Category;
use Stunami\Scraper\Parser\CategoryParser;


class CategoryParserTest extends \PHPUnit_Framework_TestCase
{

    public function testParse()
    {
        $categoryParser = new CategoryParser(new CrawlerFactory());

        $category = $categoryParser->parse(file_get_contents(__DIR__ .'/../Fixtures/products.html'));

        $this->assertInstanceOf(Category::class, $category);
        $this->assertCount(7, $category->getLinks());
    }
}
