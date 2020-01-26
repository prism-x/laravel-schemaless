<?php

namespace PrismX\Schemaless\Traits;

use PrismX\Schemaless\Document;

trait HasSchemalessRelationships
{
    public function itemable(string $class = Document::class)
    {
        return $this->morphTo($this->getItemMorphColumnName())
            ->where($this->getItemMorphColumnName().'_type', $class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function item(string $class = Document::class)
    {
        return $this->morphOne(Document::class, $this->getItemMorphColumnName());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function items(string $class = Document::class)
    {
        return $this->morphMany(Document::class, $this->getItemMorphColumnName());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function manyItems(string $class = Document::class)
    {
        return $this->morphToMany(
            $class,
            'child',
            'item_items',
            'child_id',
            'parent_id'
        )
            ->withPivot('parent_type', 'parent_id', 'child_type', 'child_id')
            ->wherePivot('parent_type', get_class($this))
            ->withPivotValue('parent_type', get_class($this));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function byManyItems(string $class = Document::class)
    {
        return $this->morphedByMany(
            $class,
            'parent',
            'item_items',
            'parent_id',
            'child_id'
        )
            ->withPivot('parent_type', 'parent_id', 'child_type', 'child_id')
            ->wherePivot('child_type', get_class($this))
            ->withPivotValue('child_type', get_class($this));
    }

    /**
     * @override
     *
     * @return string
     */
    public function getItemMorphColumnName()
    {
        return 'itemable';
    }
}
