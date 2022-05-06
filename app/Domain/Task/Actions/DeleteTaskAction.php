<?php

namespace App\Domain\Task\Actions;

use App\Domain\Task\Models\Task;

class DeleteTaskAction
{
    public function execute(int $id)
    {
        $task = Task::find($id);
        if($task != null)
        {
            $task->delete();
            return true;
        }
        else 
        {
            return false;
        }
    }
}
