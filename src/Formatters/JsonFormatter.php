<?php

namespace REBELinBLUE\Sainsburys\Formatters;

class JsonFormatter
{
    /**
     * The JSON data
     * @var array
     */
    private $data;

    /**
     * Whether or not to pretty print the JSON.
     * @var boolean
     */
    private $pretty = false;

    /**
     * Class constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Sets the pretty print option.
     *
     * @param boolean $pretty Whether or not to pretty print the JSON
     */
    public function setPretty($pretty)
    {
        $this->pretty = (bool) $pretty;
    }

    /**
     * Converts the data to JSON string.
     *
     * @return string
     */
    public function getFormatted()
    {
        $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
        if ($this->pretty) {
            $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;
        }

        return json_encode($this->data, $options);
    }
}
