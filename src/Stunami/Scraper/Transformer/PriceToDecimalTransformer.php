<?php

namespace Stunami\Scraper\Transformer;

/**
 * Class PriceToDecimalTransformer
 *
 * Converts string representations of price to stripped decimal version
 *
 * @package Stunami\Scraper\Transformer
 */
final class PriceToDecimalTransformer
{
    /**
     * Returns string decimal of price string
     *
     * @param $string
     * @return string
     */
    public function transform($string)
    {
        preg_match('/\d+\.\d{2}/', $string, $matches);

        return isset($matches[0]) ? money_format('%i', $matches[0]) : "0.00";
    }
}