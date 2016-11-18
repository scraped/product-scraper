<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 13:37
 */

namespace Stunami\Scraper\Model;


class Summary
{
    private $results;

    private $total;

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param ProductData[]
     */
    public function setResults(array $results)
    {
        $this->results = $results;

        $total = 0;
        foreach ($results as $result) {
            $total += $result->getUnitPrice();
        }

        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return money_format('%i', $this->total);
    }
}