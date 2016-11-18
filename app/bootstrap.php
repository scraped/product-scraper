<?php

require_once(__DIR__.'/../vendor/autoload.php');
use Stunami\Scraper\Pimple\DomCrawlerProvider;
use Stunami\Scraper\Pimple\ScraperProvider;
use Stunami\Scraper\Pimple\SerializerProvider;
use Stunami\Scraper\ScraperApplication;

$container = new \Pimple\Container();
$container->register(new ScraperProvider());
$container->register(new DomCrawlerProvider());
$container->register(new SerializerProvider());

$app = new ScraperApplication($container);

return $app;