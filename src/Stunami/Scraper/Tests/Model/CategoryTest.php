<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 18:26
 */

namespace Stunami\Scraper\Tests\Model;


use Stunami\Scraper\Model\Category;


class CategoryTest extends \PHPUnit_Framework_TestCase
{

    public function testAddLink()
    {
        $category = new Category();
        $category->addLink('http://localhost/1');

        $this->assertCount(1, $category->getLinks());
        $this->assertEquals('http://localhost/1', $category->getLinks()[0]);

        $category->addLink('http://localhost/2');

        $this->assertCount(2, $category->getLinks());
        $this->assertEquals('http://localhost/2', $category->getLinks()[1]);
    }
}
