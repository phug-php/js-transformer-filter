<?php

namespace Phug;

class JsTransformerFilter
{
    /**
     * @var string
     */
    private $transformer;

    public function __construct($transformer)
    {
        $this->transformer = $transformer;
    }
}
