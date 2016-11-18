<?php

namespace Stunami\Scraper\Test\Command;

use Pimple\Container;
use Stunami\Scraper\Model\Product;
use Stunami\Scraper\Model\Summary;
use Stunami\Scraper\Pimple\ScraperProvider;
use Stunami\Scraper\Scraper;
use Stunami\Scraper\ScraperApplication;
use Symfony\Component\Console\Tester\CommandTester;

class ScraperCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ScraperApplication
     */
    private $application;

    public function testExecute()
    {
        $container = $this->application->getContainer();

        /**
         * Mock the Scraper to return know data
         */
        $builder = $this->getMockBuilder(Scraper::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $product1 = new Product();
        $product1->setTitle('Product One');
        $product1->setUnitPrice(1.00);
        $product1->setDescription('Product One Description');
        $product1->setSize(10.00);

        $product2 = new Product();
        $product2->setTitle('Product Two');
        $product2->setUnitPrice(2.00);
        $product2->setDescription('Product Two Description');
        $product2->setSize(20.00);

        $summary = new Summary();
        $summary->setResults([
            $product1,
            $product2
        ]);


        $builder->method('scrape')->willReturn($summary);

        $container['scraper'] = function ($c) use ($builder) {
            return $builder;
        };

        $command = $this->application->find('product:fruit:scrape');

        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $output = $commandTester->getDisplay();

        /**
         * Compare the output of Command with fixtures file
         */
        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../Fixtures/output.json', $output);
    }

    protected function setUp()
    {
        $this->application = require __DIR__  .'/../../../../../app/bootstrap.php';
    }

}
