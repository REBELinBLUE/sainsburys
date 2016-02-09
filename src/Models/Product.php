<?php

namespace REBELinBLUE\Sainsburys\Models;

/**
 * The product model.
 * A simple class to extend ArrayObject so that we can use an object as an array.
 * @todo Expand to add an isValid method which checks the required fields are set.
 */
class Product extends \ArrayObject
{
    /**
     * The class constructor, to ensure ARRAY_AS_PROPS is set.
     *
     * @param array $data The predefined values
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
