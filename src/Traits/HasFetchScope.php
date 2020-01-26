<?php

namespace PrismX\Schemaless\Traits;

trait HasFetchScope
{
    public function scopeFetch($query, $locale = null)
    {
        return $query
            ->where('collection', $this->collection)
            ->where('locale', $locale ?? app()->getLocale())
            ->firstOrFail();
    }

    public function scopeFetchAll($query, $locale = null)
    {
        return $query
            ->where('collection', $this->collection)
            ->where('locale', $locale ?? app()->getLocale())
            ->get();
    }
}
