<?php

namespace PrismX\Schemaless\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DocumentScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (get_class($model) !== "PrismX\Schemaless\Document") {
            $builder
                ->where('model', get_class($model));
        }
    }
}
