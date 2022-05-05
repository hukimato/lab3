<?php

namespace App\Http\ApiV1\Modules\MyLists\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\MetaResource;

class MyListCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'errors' => [
                'error' => 'error',
            ],
            'meta' => [
                'lists_count' => $this->collection->count()
            ],
        ];
    }
}
