<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 18:59
 */

namespace Stunami\Scraper\Tests\Transformer;


use Stunami\Scraper\Transformer\ByteToSizeTransformer;


class ByteToSizeTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function transformDataProvider()
    {
        return [
            [
                '',
                '0b'
            ],
            [
                1000,
                '1kb'
            ],
            [
                '',
                '0b'
            ],
            [
                1000000,
                '1mb'
            ],
            [
                1000000000,
                '1gb'
            ],
            [
                1000000000000,
                '1tb'
            ],
            [
                1000000000000000,
                '1pb'
            ],
            [
                1000000000000000000,
                '1eb'
            ],
        ];
    }

    /**
     * @dataProvider transformDataProvider
     * @param $input
     * @param $expected
     */
    public function testTransform($input, $expected)
    {
        $transformer = new ByteToSizeTransformer();
        $this->assertEquals($expected, $transformer->transform($input));
    }
}
