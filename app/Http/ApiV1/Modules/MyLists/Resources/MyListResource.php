<?php

namespace App\Http\ApiV1\Modules\MyLists\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyListResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
