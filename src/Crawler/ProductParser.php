<?php

namespace REBELinBLUE\Sainsburys\Crawler;

use REBELinBLUE\Sainsburys\Models\Product;
use Symfony\Component\DomCrawler\Crawler;
use REBELinBLUE\Sainsburys\Scraper;

class ProductParser
{
    private $crawler;
    private $details;
    private $length;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function getProduct()
    {
        return [
            'title' => $this->getTitle(),
            'size' => $this->getPageSize(),
            'description' => $this->getDescription(),
            'unit_price' => $this->getUnitPrice()
        ];
    }

    private function getTitle()
    {
        $title = $this->crawler
                      ->filter('.productInfo h3 a')
                      ->text();

        return trim($title);
    }

    private function getUnitPrice() // FIXME: Convert to float
    {
        $price = $this->crawler
                      ->filter('.addToTrolleytabBox .pricePerUnit')
                      ->text();

        return str_replace(['&pound', '/unit'], '', trim($price));
    }

    private function getDetails()
    {
        if (is_null($this->details))
        {
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

    private function getDescription()
    {
        $details = $this->getDetails();

        return '';
    }

    private function getPageSize()
    {
        $this->getDetails();

        return number_format($this->length / 1024, 2) . 'kb';
    }
}
