<?php

namespace Stunami\Scraper\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Scraper
 *
 * Command to scrape and display product information
 *
 * @package Stunami\Scraper\Command
 */
final class ScraperCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('product:fruit:scrape')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getApplication()->getContainer();

        try {
            $summary = $container['scraper']->scrape(
                'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html'
            );

            $json = $container['serializer']->serialize($summary, 'json');

            $output->write($json);

        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Error: %s</error>', $e->getMessage()));
        }

    }

}