<?php

use REBELinBLUE\Sainsburys\Parsers\ProductTotalParser;

/**
 * Test the price parser class.
 */
class TotalPriceParserTest extends \PHPUnit_Framework_TestCase
{
    public function testPrices()
    {
        $parser = new ProductTotalParser;

        $this->assertEquals(0, $parser->getTotalPrice());
    }
}