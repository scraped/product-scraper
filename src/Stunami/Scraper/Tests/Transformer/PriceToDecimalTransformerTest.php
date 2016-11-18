<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 19:06
 */

namespace Stunami\Scraper\Tests\Transformer;


use Stunami\Scraper\Transformer\PriceToDecimalTransformer;


/**
 * Class PriceToDecimalTransformerTest
 * @package Stunami\Scraper\Tests\Transformer
 */
class PriceToDecimalTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function transformDataProvider()
    {
        return [
            [
                '£3.50',
                '3.50'
            ],
            [
                '£3.50/unit',
                '3.50'
            ],
            [
                '3.50/unit',
                '3.50'
            ],
            [
                '',
                '0.00'
            ],
            [
                'bad',
                '0.00'
            ]
        ];
    }

    /**
     * @dataProvider transformDataProvider
     */
    public function testTransform($input, $expected)
    {
        $transformer = new PriceToDecimalTransformer();

        $this->assertEquals($expected, $transformer->transform($input));
    }
}
