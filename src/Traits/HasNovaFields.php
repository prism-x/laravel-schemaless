<?php

namespace PrismX\Schemaless\Traits;

trait HasNovaFields
{
    abstract public function novaFields(): array;

    public function getNovaFields(): array
    {
        return collect($this->novaFields())->map(function ($field) {
            return $field->resolveUsing(function ($value) {
                return $value;
            })->hideFromIndex();
        })->toArray();
    }
}
