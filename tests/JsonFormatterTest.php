<?php

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
        $simple_json = file_get_contents(__DIR__ . '/fixtures/simple.json');
        $formatted_json = file_get_contents(__DIR__ . '/fixtures/formatted_simple.json');

        $formatter = new JsonFormatter([
            'key' => 'value'
        ]);

        $this->assertEquals($simple_json, $formatter->getFormatted());

        // Make sure that turning on pretty doesn't change the output
        $formatter->setPretty(true);
        $this->assertEquals($formatted_json, $formatter->getFormatted());

        // Then that turning off pretty means the unformatted data is returned
        $formatter->setPretty(false);
        $this->assertEquals($simple_json, $formatter->getFormatted());
    }
}
