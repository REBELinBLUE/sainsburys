<?php

use REBELinBLUE\Sainsburys\Scraper;

/**
 * Test the Scraper class.
 */
class ScraperTest extends \PHPUnit_Framework_TestCase
{
	private $scraper;

	public function setUp()
	{
		$this->scraper = new Scraper;
	}

    /**
     * Text the scraper class
     *
     * @return void
     */
    public function testInvalidUrl()
    {
        $this->scraper->fetchAndProcess('http://invalid.local'); //http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html');
    }
}
