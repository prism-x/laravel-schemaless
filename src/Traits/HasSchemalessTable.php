<?php

namespace PrismX\Schemaless\Traits;

use Illuminate\Database\Eloquent\Model;
use PrismX\Schemaless\Support\DocumentScope;

trait HasSchemalessTable
{
    public static function bootHasSchemalessTable()
    {
        static::saving(function (Model &$model) {
            $model->model = $model->model ?: get_class($model);
            $model->locale = $model->locale ?: app()->getLocale();
        });

        // limit query of this model to its type
        static::addGlobalScope(new DocumentScope());
    }

    public function getTable()
    {
        return '_documents';
    }

    public function getFillable()
    {
        return array_merge(
            parent::getFillable(),
            [
                'model',
                'locale',
                'collection',
            ]
        );
    }
}
