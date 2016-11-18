<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 17:59
 */

namespace Stunami\Scraper\Tests\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Stunami\Scraper\Http\Psr7Client;


class Psr7ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $guzzle = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $response = $this->getMockBuilder(ResponseInterface::class)
            ->getMock()
        ;

        $guzzle->method('request')->willReturn($response);

        $client = new Psr7Client($guzzle);

        $this->assertEquals($response, $client->get('http://localhost'));
    }

    public function testGetAsync()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar']),
            new Response(200, ['Content-Length' => 0]),
        ]);

        $handler = HandlerStack::create($mock);

        $guzzle = new Client(['handler' => $handler]);

        $client = new Psr7Client($guzzle);

        $responses = $client->getConcurrent(['http://localhost/1', 'http://localhost/2']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }
}
