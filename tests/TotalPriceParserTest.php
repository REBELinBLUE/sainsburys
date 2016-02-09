<?php

use REBELinBLUE\Sainsburys\Parsers\ProductTotalParser;

use REBELinBLUE\Sainsburys\Models\Product;

/**
 * Test the price parser class.
 */
class TotalPriceParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that no products returns a price of 0.
     * @return void
     */
    public function testNoProducts()
    {
        $parser = new ProductTotalParser;

        $this->assertEquals(0, $parser->getTotalPrice());
    }

    public function testSingleProducts()
    {
        $peaches = new Product;
        $peaches->unit_price = 1.00;
        $peaches->title = 'Peaches';

        $parser = new ProductTotalParser([$peaches]);

        $this->assertEquals(1.00, $parser->getTotalPrice());
    }

    public function testSumProducts()
    {
        $peaches = new Product;
        $peaches->unit_price = 1.00;
        $peaches->title = 'Peaches';

        $apples = new Product;
        $apples->unit_price = 0.75;
        $apples->title = 'Apples';

        $parser = new ProductTotalParser([$peaches, $apples]);

        $this->assertEquals(1.75, $parser->getTotalPrice());
    }

    public function testInvalidProducts()
    {
        $invalid = new \StdClass;
        $invalid->unit_price = 0;

        $parser = new ProductTotalParser([$invalid]);

        $this->assertEquals(0, $parser->getTotalPrice());
    }
}