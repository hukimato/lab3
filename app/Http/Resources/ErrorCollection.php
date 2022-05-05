<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ErrorCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'errors' => $this->collection,
        ];
    }
}
