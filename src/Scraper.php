<?php

namespace REBELinBLUE\Sainsburys;

use Goutte\Client;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Scrapper class
 */
class Scraper
{
    /**
     * HTTP client.
     * @var Client
     */
    private $client;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * Fetches a URL and processes it.
     *
     * @param  string $url The URL to process
     * @return Crawler
     * @throws ConnectException
     */
    public function fetchAndProcess($url)
    {
        return $this->request($url, 'GET');
    }

    /**
     * Requests a URL
     * @param  string $url    The URL to request
     * @param  string $method The HTTP method
     * @return Crawler
     * @throws ConnectException
     */
    private function request($url, $method = 'GET')
    {
        try
        {
            return $this->client->request(strtoupper($method), $url);
        }
        catch (ConnectException $error)
        {
            throw $error;
        }
    }
}
