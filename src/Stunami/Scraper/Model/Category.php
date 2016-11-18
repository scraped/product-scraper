<?php

namespace Stunami\Scraper\Model;

class Category
{
    private $links = [];

    /**
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    public function addLink($link)
    {
        $this->links[] = $link;
    }
}