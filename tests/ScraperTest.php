<?php

namespace REBELinBLUE\Sainsburys\Tests;

use REBELinBLUE\Sainsburys\Scraper;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

/**
 * Test the Scraper class.
 * @todo Update this to use a mock
 */
class ScraperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of the scraper class
     * @var Scraper
     */
    private $scraper;

    /**
     * Setup method.
     */
    public function setUp()
    {
        $this->scraper = new Scraper;
    }

    /**
     * Test that an invalid URL gives the expected exception.
     *
     * @return void
     * @expectedException GuzzleHttp\Exception\ConnectException
     */
    public function testInvalidUrl()
    {
        $this->scraper->fetch('http://invalid.local');
    }

    /**
     * Test that something which is not a URL gives the excepted exception.
     *
     * @return void
     * @expectedException GuzzleHttp\Exception\ConnectException
     */
    public function testNotUrl()
    {
        $this->scraper->fetch('not-a-url');
    }

    /**
     * Test that a valid URL does not throw an error and the fetch method returns the response.
     *
     * @return void
     */
    public function testIsValidUrl()
    {
        $this->setMockHandler('simple');

        $crawler = $this->scraper->fetch('http://www.google.com');

        $this->assertInstanceOf('Symfony\\Component\\DomCrawler\\Crawler', $crawler);
        $this->assertRegExp('/Hi/', $crawler->html());
    }

    /**
     * Test that a valid URL does not throw an error and the fetch method returns the response.
     *
     * @return void
     */
    public function testValidContentLength()
    {
        $this->setMockHandler('simple');

        $crawler = $this->scraper->fetch('http://www.google.com');

        // Check the Content-Length header is returned correctly
        $this->assertEquals(filesize(__DIR__ . '/fixtures/simple.html'), $this->scraper->getResponseSize());
    }

    /**
     * Tests a valid response.
     *
     * @return void
     */
    public function testSainsburyUrl()
    {
        $this->setMockHandler('5_products');

        $url = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';
        $this->scraper->fetchAndProcess($url);
    }

    /**
     * Sets the mock handler on the scraper
     *
     * @param string $filename
     * @return void
     */
    private function setMockHandler($filename)
    {
        $guzzle = $this->getGuzzle($this->getFileResponse($filename));

        // Set guzzle to use the mock handler
        $this->scraper
             ->getClient()
             ->setClient($guzzle);
    }

    /**
     * Generates a guzzle mock handler
     *
     * @param Object $response
     * @return GuzzleClient
     */
    private function getGuzzle($response)
    {
        $mock = new MockHandler([
            $response
        ]);

        return new GuzzleClient([
            'handler' => HandlerStack::create($mock)
        ]);
    }

    /**
     * Simple method to load the HTML test data
     *
     * @param string $type
     * @return string
     */
    private function getTestData($type)
    {
        return file_get_contents(__DIR__ . '/fixtures/' . $type . '.html');
    }

    /**
     * Generates a mock response based on the content of a file
     *
     * @param string $file
     * @return GuzzleResponse
     */
    private function getFileResponse($file)
    {
        $body = $this->getTestData($file);

        return new GuzzleResponse(200, [
            'Content-Length' => strlen($body)
        ], $body);
    }
}
