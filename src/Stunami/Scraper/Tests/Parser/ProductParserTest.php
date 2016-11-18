<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 18:54
 */

namespace Stunami\Scraper\Tests\Parser;


use Stunami\Scraper\Crawler\CrawlerFactory;
use Stunami\Scraper\Model\Product;
use Stunami\Scraper\Parser\ProductParser;
use Stunami\Scraper\Transformer\PriceToDecimalTransformer;


class ProductParserTest extends \PHPUnit_Framework_TestCase
{

    public function testParse()
    {
        $productParser = new ProductParser(new CrawlerFactory(), new PriceToDecimalTransformer());

        $product = $productParser->parse(file_get_contents(__DIR__ . '/../Fixtures/sainsburys-apricot-ripe---ready-320g.html'));

        $this->assertInstanceOf(Product::class, $product);

        $this->assertEquals('Sainsbury\'s Apricot Ripe & Ready x5', $product->getTitle());
        $this->assertEquals('Apricots', $product->getDescription());
        $this->assertEquals('3.50', $product->getUnitPrice());
        $this->assertEquals(0, $product->getSize());
    }
}
