<?php

namespace PrismX\Schemaless;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use PrismX\Schemaless\Commands\MakeDocument;
use PrismX\Schemaless\Commands\MakeDocumentResource;

class SchemalessServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeDocument::class,
                MakeDocumentResource::class,
            ]);
        }

        if (! class_exists('CreateDocumentsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create__documents_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create__documents_table.php'),
            ], 'migrations');
        }

        Str::macro('normalize', function ($str) {
            /** @var \Illuminate\Support\Str $this */
            $str = preg_replace('/(?<!^)[A-Z]/', ' $0', $str);
            $str = Str::slug($str);
            $str = str_replace('-', ' ', $str);

            return Str::title($str);
        });
    }

    public function register()
    {
    }
}
