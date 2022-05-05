<?php

namespace App\Domain\Task\Actions;

use App\Domain\Task\Models\Task;
use Illuminate\Support\Facades\DB;

class ListTaskAction
{
    public function execute(int $skip, int $take, int $listId)
    {
        $task = Task::where('list_id', $listId)->get();
        //$task->where('list_id', $listId);

        if($skip > 0 && $take > 0){
            $myList = Task::get('list_id', $listId)->skip($skip)->take($take)->get();
        }
        return $task;   
    }
}
