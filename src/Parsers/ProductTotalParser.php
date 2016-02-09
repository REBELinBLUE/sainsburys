<?php

namespace REBELinBLUE\Sainsburys\Parsers;

use REBELinBLUE\Sainsburys\Models\Product;

/**
 * Class which takes a coll
 */
class ProductTotalParser
{
    /**
     * The array of products
     * @var array
     */
    private $products;

    /**
     * The total price of the products
     * @var float
     */
    private $total;

    /**
     * Class constructor.
     * @param array $products
     */
    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    /**
     * Get the total price of the products.
     * Cache the results so that multiple calls to the method don't have to calculate multiple times.
     * @return float
     */
    public function getTotalPrice()
    {
        if (is_null($this->total)) {
            $this->total = $this->calculateCombinedPrice($this->products);
        }

        return $this->total;
    }

    /**
     * Calculates the combined price of the passed in products
     * 
     * @param  array  $products 
     * @return float
     */
    private function calculateCombinedPrice(array $products)
    {
        $price = 0;

        foreach ($products as $product) {
            if ($product instanceof Product && property_exists($product, 'unit_price') && is_numeric($product->unit_price)) {
                $price += $product->unit_price;
            }
        }

        return number_format($price, 2);
    }
}
