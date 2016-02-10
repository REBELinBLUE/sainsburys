<?php

namespace REBELinBLUE\Sainsburys\Tests;

use REBELinBLUE\Sainsburys\Formatters\JsonFormatter;

/**
 * Test the JSON formatter class.
 */
class JsonFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that an empty array returns the expected object.
     */
    public function testEmpty()
    {
        $formatter = new JsonFormatter([]);

        $this->assertEquals('[]', $formatter->getFormatted());

        // Make sure that turning on pretty doesn't change the output
        $formatter->setPretty(true);
        $this->assertEquals('[]', $formatter->getFormatted());

        // Then that turning off pretty doesn't break it
        $formatter->setPretty(false);
        $this->assertEquals('[]', $formatter->getFormatted());
    }

    /**
     * Test the formatter outputs a simple key/value correctly
     **/
    public function testSingleEntry()
    {
        $formatter = new JsonFormatter([
            'key' => 'value',
        ]);

        $this->doTests($formatter, 'single');
    }

    /**
     * Test multiple key/value pairs in the JSON object
     */
    public function testMultipleEntries()
    {
        $formatter = new JsonFormatter([
            'key' => 'value',
            'foo' => 'bar',
            'baz' => 500,
        ]);

        $this->doTests($formatter, 'multiple');
    }

    /**
     * Test array formatting.
     **/
    public function testArrayEntries()
    {
        $formatter = new JsonFormatter([
            ['key' => 'value'],
            ['foo' => 'bar'],
        ]);

        $this->doTests($formatter, 'array');
    }

    /**
     * Simple method to run the 3 tests.
     *
     * @param JsonFormatter $formatter
     * @param string $fixture The name of the fixture file to use
     * @return void
     */
    private function doTests(JsonFormatter $formatter, $fixture)
    {
        $simple    = $this->getTestData($fixture);
        $formatted = $this->getTestData($fixture . '-formatted');

        $this->assertEquals($simple, $formatter->getFormatted());

        // Make sure that turning on pretty doesn't change the output
        $formatter->setPretty(true);
        $this->assertEquals($formatted, $formatter->getFormatted());

        // Then that turning off pretty means the unformatted data is returned
        $formatter->setPretty(false);
        $this->assertEquals($simple, $formatter->getFormatted());
    }

    /**
     * Simple method to load the JSON test data
     *
     * @param string $type
     * @return string
     */
    private function getTestData($type)
    {
        return file_get_contents(__DIR__ . '/fixtures/' . $type . '.json');
    }
}
