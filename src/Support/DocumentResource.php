<?php

namespace PrismX\Schemaless\Support;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DocumentResource extends Resource
{
    public static $collection = 'documents';

    public static $model = 'PrismX\Schemaless\Document';

    public static $title = 'model';

    public static $search = ['model'];

    public function __construct($resource)
    {
        if ($resource->model) {
            static::$model = $resource->model;
            $this->resource = (new $resource->model())->find($resource->id);
        }
    }

    public function fields(Request $request)
    {
        return array_merge([
            Text::make('Document', function () {
                return Str::normalize(Str::afterLast($this->model, '\\'));
            })->onlyOnIndex(),
        ], $this->resource->getNovaFields()
        );
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query
            ->where('collection', static::$collection)
            ->where('locale', app()->getLocale());
    }

    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query
            ->where('collection', static::$collection)
            ->where('locale', app()->getLocale()));
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
}
