<?php

namespace PrismX\Schemaless\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeDocumentResource extends GeneratorCommand
{
    protected $signature = 'document:resource {name}';
    protected $description = 'Command description';

    protected $type = 'Document Resource';

    protected function getStub()
    {
        return __DIR__.'/../../stubs/DocumentResource.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Nova';
    }
}
