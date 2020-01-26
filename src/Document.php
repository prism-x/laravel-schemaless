<?php

namespace PrismX\Schemaless;

use Illuminate\Database\Eloquent\Model;
use PrismX\Schemaless\Traits\HasFetchScope;
use PrismX\Schemaless\Traits\HasSchemalessAttributes;
use PrismX\Schemaless\Traits\HasSchemalessTable;

class Document extends Model
{
    use HasSchemalessAttributes, HasSchemalessTable, HasFetchScope;

    public $collection = 'documents';

    protected $guarded = [
        'model',
    ];
}
