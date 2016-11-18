<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 19:55
 */
namespace Stunami\Scraper\Http;

use Psr\Http\Message\ResponseInterface;


/**
 * Class HttpClient
 *
 * Simple Interface for HTTP Clients
 *
 * @package Stunami\Scraper\Http
 */
interface ClientInterface
{
    /**
     * @param $url
     * @return ResponseInterface
     */
    public function get($url);

    /**
     * @param array $urls
     * @return array
     */
    public function getConcurrent(array $urls);
}