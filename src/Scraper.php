<?php

namespace REBELinBLUE\Sainsburys;

use Goutte\Client;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\DomCrawler\Crawler;
use REBELinBLUE\Sainsburys\Parsers\ProductParser;

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
     * @return array An array of Product models
     * @throws ConnectException
     * @todo Could replace this with a Collection object instead of an array
     */
    public function fetchAndProcess($url)
    {
        return $this->getProductContainers($this->fetch($url))->each(function (Crawler $node) {
            $parser = new ProductParser($node);

            return $parser->getProduct();
        });
    }

    /**
     * Fetches a URL.
     *
     * @param  string $url The URL to process
     * @return Crawler
     * @throws ConnectException
     */
    public function fetch($url)
    {
        return $this->request($url, 'GET');
    }

    /**
     * Gets the products from the response.
     *
     * @param  Crawler $response [description]
     * @return [type]            [description]
     */
    public function getProductContainers(Crawler $response)
    {
        return $response->filter('.productInner');
    }

    /**
     * Requests a URL.
     *
     * @param  string $url    The URL to request
     * @param  string $method The HTTP method
     * @return Crawler
     * @throws ConnectException
     */
    private function request($url, $method = 'GET')
    {
        try {
            return $this->client->request(strtoupper($method), $url);
        } catch (ConnectException $error) {
            throw $error;
        }
    }

    /**
     * Get's the content length of the latest request.
     *
     * @return string
     */
    public function getResponseSize()
    {
        $response = $this->client->getInternalResponse();

        return $response->getHeader('Content-Length');
    }
}
