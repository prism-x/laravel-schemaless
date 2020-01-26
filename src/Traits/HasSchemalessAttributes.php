<?php

namespace PrismX\Schemaless\Traits;

use Illuminate\Support\Str;

trait HasSchemalessAttributes
{
    public $schema = [];

    protected function getSchemaColumnName()
    {
        return '_attributes';
    }

    public function initializeHasSchemalessAttributes()
    {
        $this->fillable(
            array_merge(
                $this->getFillable(),
                array_keys($this->schema ?? [])
            )
        );

        $this->addHidden([$this->getSchemaColumnName()]);
    }

    public function get_attributesAttribute($value): array
    {
        $value = $value ?? [];
        $value = ! is_array($value) ? json_decode($value, true) : $value;

        return array_merge(
            $this->schema ?? [],
            $value ?? []
        );
    }

    public function set_attributesAttribute($value)
    {
        $this->attributes[$this->getSchemaColumnName()] = json_encode($value);
    }

    public function getAttribute($key)
    {
        if (array_key_exists($key, $this->schema)) {
            $value = $this->{$this->getSchemaColumnName()}[$key] ?? null;

            return isset($this->getCasts()[$key]) ? $this->castAttribute($key, $value) : $value;
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if (array_key_exists($key, $this->schema)) {
            $this->{$this->getSchemaColumnName()} = array_merge($this->{$this->getSchemaColumnName()}, [$key => $value]);

            return;
        }

        parent::setAttribute($key, $value);
    }

    public function getSchema()
    {
        return collect($this->schema)
            ->mapWithKeys(function ($default, $key) {
                return [$key => $this->getAttribute($key)];
            })
            ->toArray();
    }

    public function setSchema(array $attributes = [])
    {
        $this->schema = $attributes;
    }

    public function toArray()
    {
        return array_merge(
            parent::toArray(),
            $this->getSchema()
        );
    }

    protected function mutateAttribute($key, $value)
    {
        $attribute = Str::startsWith($key, '_') ? $key : Str::studly($key);

        return $this->{"get{$attribute}Attribute"}($value);
    }

    public function hasGetMutator($key)
    {
        $attribute = Str::startsWith($key, '_') ? $key : Str::studly($key);

        return method_exists($this, "get{$attribute}Attribute");
    }

    public function hasSetMutator($key)
    {
        $attribute = Str::startsWith($key, '_') ? $key : Str::studly($key);

        return method_exists($this, "set{$attribute}Attribute");
    }

    protected function setMutatedAttributeValue($key, $value)
    {
        $attribute = Str::startsWith($key, '_') ? $key : Str::studly($key);

        return $this->{"set{$attribute}Attribute"}($value);
    }
}
