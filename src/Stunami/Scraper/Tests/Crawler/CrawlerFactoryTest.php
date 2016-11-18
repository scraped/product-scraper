<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 17:32
 */

namespace Stunami\Scraper\Tests\Crawler;


use Stunami\Scraper\Crawler\CrawlerFactory;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $crawlerFactory = new CrawlerFactory();

        $html = "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <title>title</title>
    <link rel=\"stylesheet\" href=\"style.css\">
    <script src=\"script.js\"></script>
  </head>
  <body>
    <!-- page content -->
  </body>
</html>";
        $this->assertInstanceOf(Crawler::class, $crawlerFactory->create($html));
    }
}
