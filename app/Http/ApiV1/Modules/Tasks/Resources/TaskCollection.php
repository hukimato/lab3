<?php

namespace App\Http\ApiV1\Modules\Tasks\Resources;

use App\Http\ApiV1\Modules\Tasks\Resources\TaskResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\MetaResource;

class TaskCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'errors' => [
                'error' => [],
            ],
            'meta' => [
                'lists_count' => $this->collection->count()
            ],
        ];
    }
}
