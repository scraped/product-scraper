<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 17:47
 */

namespace Stunami\Scraper\Tests\Fetcher;


use Psr\Http\Message\ResponseInterface;
use Stunami\Scraper\Fetcher\HttpFetcher;
use Stunami\Scraper\Http\ClientInterface;


class HttpFetcherTest extends \PHPUnit_Framework_TestCase
{

    public function testFetch()
    {
        $client = $this->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = $this->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $client->method('get')->willReturn($response);

        $fetcher = new HttpFetcher($client);

        $response = $fetcher->fetch('http://localhost');

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testMultiFetch()
    {
        $client = $this->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response1 = $this->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $response2 = $this->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $client->method('getConcurrent')->willReturn([$response1, $response2]);

        $fetcher = new HttpFetcher($client);

        $responses = $fetcher->multiFetch(['http://localhost']);

        $this->assertEquals($response1, $responses[0]);
        $this->assertEquals($response2, $responses[1]);
    }
}
