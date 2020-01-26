<?php

namespace PrismX\Schemaless\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeDocument extends GeneratorCommand
{
    protected $signature = 'make:document {name}';
    protected $description = 'Command description';

    protected $type = 'Document';

    protected function getStub()
    {
        return __DIR__.'/../../stubs/Document.stub';
    }
}
