<?php

use REBELinBLUE\Sainsburys\Scraper;

/**
 * Test the Scraper class.
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
     * Test that a valid URL does not throw an error.
     *
     * @return void
     */
    public function testIsValidUrl()
    {
        $this->scraper->fetch('http://www.google.com');
    }
}
