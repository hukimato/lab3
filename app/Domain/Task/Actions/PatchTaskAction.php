<?php

namespace App\Domain\Task\Actions;

use App\Domain\Task\Models\Task;

class PatchTaskAction
{
    public function execute(int $taskId, string $content=null, int $list_id=null, bool $isDone=null): Task
    {
        $task = Task::find($taskId);
        if($task == null){
            return null;
        }
        if($content!= null)
        {
            $task->content = $content;
        }
        if($list_id != null)
        {
            $task->list_id = $list_id;
        }
        if($isDone != null)
        {
            $task->is_done =$isDone;
        }
        $task->save();
        return $task;   
    }
}
