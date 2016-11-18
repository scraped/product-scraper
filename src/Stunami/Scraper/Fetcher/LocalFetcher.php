<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 18/11/2016
 * Time: 20:12
 */

namespace Stunami\Scraper\Fetcher;


use GuzzleHttp\Psr7\Response;

class LocalFetcher implements FetcherInterface
{
    private $path;

    /**
     * LocalFetcher constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function fetch($uri)
    {
        return new Response(
            200, [
                'Content-Length' => [100],
            ],
            file_get_contents($this->path.$uri)
        );
    }

    public function multiFetch(array $uri)
    {
        $responses = [];
        foreach ($uri as $file) {
            $responses[] = new Response(
                200, [
                    'Content-Length' => [100],
                ],
                file_get_contents($this->path.$file));
        }

        return $responses;
    }


}