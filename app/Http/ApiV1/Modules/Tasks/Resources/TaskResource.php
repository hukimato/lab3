<?php

namespace App\Http\ApiV1\Modules\Tasks\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'list_id' => $this->list_id,
            'is_done' => $this->is_done,
        ];
    }
}
