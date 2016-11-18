<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 17/11/2016
 * Time: 21:23
 */

namespace Stunami\Scraper\Model;

class Product
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $size;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var string
     */
    private $description;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}