<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 18:29
 */

namespace Stunami\Scraper\Tests\Model;


use Stunami\Scraper\Model\Product;


class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Product
     */
    private $product;

    public function testTitle()
    {
        $this->product->setTitle('Test Title');

        $this->assertEquals('Test Title', $this->product->getTitle());
    }

    public function testUnitPrice()
    {
        $this->product->setUnitPrice(10.01);

        $this->assertEquals(10.01, $this->product->getUnitPrice());
    }

    public function testDescription()
    {
        $this->product->setDescription('Product Description');

        $this->assertEquals('Product Description', $this->product->getDescription());
    }

    public function testSize()
    {
        $this->product->setSize(100);

        $this->assertEquals(100, $this->product->getSize());
    }

    protected function setUp()
    {
        $this->product = new Product();
    }


}
