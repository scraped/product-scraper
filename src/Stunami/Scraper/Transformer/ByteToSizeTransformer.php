<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 17/11/2016
 * Time: 21:49
 */

namespace Stunami\Scraper\Transformer;

/**
 * Class ByteToSizeTransformer
 *
 * Converts bytes to string unit version
 *
 * @package Stunami\Scraper\Transformer
 */
final class ByteToSizeTransformer
{
    /**
     * @var int
     */
    private $precision = 2;

    /**
     * Transforms bytes into string with units
     *
     * @param $bytes
     * @return string
     */
    public function transform($bytes)
    {
        if (!is_numeric($bytes)) {
            return '0b';
        }

        $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb'];

        return round(
            $bytes / pow(1000, ($i = floor(log($bytes, 1000)))),
            $this->precision
        ).$unit[$i];
    }
}