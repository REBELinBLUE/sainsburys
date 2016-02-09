<?php

use REBELinBLUE\Sainsburys\Parsers\ProductTotalParser;
use REBELinBLUE\Sainsburys\Models\Product;

/**
 * Test the price parser class.
 */
class ProductTotalParserTest extends \PHPUnit_Framework_TestCase
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

    /**
     * Test that the parser works with only one product.
     *
     * @return void
     */
    public function testSingleProducts()
    {
        $peaches = new Product;
        $peaches->unit_price = 1.00;
        $peaches->title = 'Peaches';

        $parser = new ProductTotalParser([$peaches]);

        $this->assertEquals(1.00, $parser->getTotalPrice());
    }

    /**
     * Test that the parser works with multiple products.
     *
     * @return void
     */
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

    /**
     * Test that the parser handles invalid objects.
     *
     * @return void
     */
    public function testInvalidProducts()
    {
        $invalid = new \StdClass;
        $invalid->unit_price = 0;

        $parser = new ProductTotalParser([$invalid]);

        $this->assertEquals(0, $parser->getTotalPrice());
    }

    /**
     * Test that the parser handles invalid prices
     *
     * @return void
     */
    public function testInvalidPrice()
    {
        $peaches = new Product;
        $peaches->unit_price = 'unknown';
        $peaches->title = 'Peaches';

        $parser = new ProductTotalParser([$peaches]);

        $this->assertEquals(0.00, $parser->getTotalPrice());
    }

    /**
     * Test that the price is returned with 2 decimal places.
     *
     * @return void
     */
    public function testPriceHas2DecminalPlaces()
    {
        $peaches = new Product;
        $peaches->unit_price = 1.5;
        $peaches->title = 'Peaches';

        $parser = new ProductTotalParser([$peaches]);

        $this->assertEquals(1.50, $parser->getTotalPrice());
    }
}
