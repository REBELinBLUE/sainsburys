<?php

namespace REBELinBLUE\Sainsburys\Parsers;

use REBELinBLUE\Sainsburys\Models\Product;
use Symfony\Component\DomCrawler\Crawler;
use REBELinBLUE\Sainsburys\Scraper;

/**
 * A class to parse the product block.
 */
class ProductParser
{
    /**
     * The Crawler oject containing the product block.
     * @var Crawler
     */
    private $crawler;

    /**
     * The Crawler object for the product details page.
     * @var Crawler
     */
    private $details;

    /**
     * The content length of the product details page.
     * @var integer
     */
    private $length;

    /**
     * Class constructor
     *
     * @param Crawler $crawler The product block from the DOM
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * Gets the product model for the Crawler passed to the constructor.
     *
     * @return Product
     */
    public function getProduct()
    {
        $product = new Product;

        $product->title = $this->getTitle();
        $product->size = $this->getPageSize();
        $product->description = $this->getDescription();
        $product->unit_price = $this->getUnitPrice();

        return $product;
    }

    /**
     * Extracts the title from the Crawler.
     *
     * @return string
     */
    private function getTitle()
    {
        $title = $this->crawler
                      ->filter('.productInfo h3 a')
                      ->text();

        return trim($title);
    }

    /**
     * Extracts the unit price from the Crawler.
     *
     * @return string
     * @todo Convert to number
     */
    private function getUnitPrice()
    {
        $price = $this->crawler
                      ->filter('.addToTrolleytabBox .pricePerUnit')
                      ->text();

        return str_replace(['&pound', '/unit'], '', trim($price));
    }

    /**
     * Gets the details page.
     *
     * @return Crawler
     * @todo Refactor this as it is not possible to mock currently
     */
    private function getDetails()
    {
        if (is_null($this->details)) {
            $url = $this->crawler
                        ->selectLink($this->getTitle())
                        ->link()
                        ->getUri();

            $scraper = new Scraper;
            $this->details = $scraper->fetch($url);
            $this->length = $scraper->getResponseSize();
        }

        return $this->details;
    }

    /**
     * Gets the description from the details page.
     *
     * @return string
     */
    private function getDescription()
    {
        $details = $this->getDetails();

        return trim($details->filter('.productText')->text());
    }

    /**
     * Gets the size of the details page.
     *
     * @return string
     */
    private function getPageSize()
    {
        $this->getDetails();

        return number_format($this->length / 1024, 2) . 'kb';
    }
}
