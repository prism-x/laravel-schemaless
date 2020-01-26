<?php

namespace PrismX\Schemaless\Tests;

use PrismX\Schemaless\Document;

class SampleDocument extends Document
{
    public $schema = [
        'title'   => null,
        'content' => [],
        'options' => 5,
    ];

    protected $casts = [
        'contents' => 'array',
    ];
}
