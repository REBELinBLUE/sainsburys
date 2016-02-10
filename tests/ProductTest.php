<?php

namespace REBELinBLUE\Sainsburys\Tests;

use REBELinBLUE\Sainsburys\Models\Product;

/**
 * Tests for the product class
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the product class is allowing properties to be used as an array
     **/
    public function testArrayProperties()
    {
        $product = new Product;
        $product->title = 'Peaches';

        $this->assertInstanceOf('\ArrayAccess', $product);

        $this->assertEquals('Peaches', $product['title']);

        $productAsJson = json_encode($product);
        $this->assertEquals('{"title":"Peaches"}', $productAsJson);

        $productAsArray = json_decode($productAsJson, true);
        $this->assertArrayHasKey('title', $productAsArray);
    }
}
