<?php

namespace Stunami\Scraper;

use Pimple\Container;
use Stunami\Scraper\Command\ScraperCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

class ScraperApplication extends Application
{
    private $container;

    public function __construct(Container $container, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->container = $container;
    }


    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        $inputDefinition->setArguments();

        return $inputDefinition;
    }

    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Override default to only use default command
     *
     * @param InputInterface $input
     * @return string
     */
    protected function getCommandName(InputInterface $input)
    {
        return 'product:fruit:scrape';
    }

    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new ScraperCommand();

        return $defaultCommands;
    }

}