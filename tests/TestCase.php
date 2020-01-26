<?php

namespace PrismX\Schemaless\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use PrismX\Schemaless\SchemalessServiceProvider;

class TestCase extends OrchestraTestCase
{
    use MockeryPHPUnitIntegration;

    public function setUp(): void
    {
        parent::setUp();
        //config(['dynamic-pages.namespace' => 'PrismX\\DynamicPages\\Tests\\']);

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [SchemalessServiceProvider::class];
    }

    protected function setUpDatabase()
    {
        include_once __DIR__.'/../database/migrations/create__documents_table.php';
        (new \CreateDocumentsTable())->up();
    }
}
