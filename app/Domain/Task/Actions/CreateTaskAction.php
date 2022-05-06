<?php

namespace App\Domain\Task\Actions;

use App\Domain\Task\Models\Task;

class CreateTaskAction
{
    public function execute(string $content, int $list_id, bool $is_done): Task 
    {
        $task = new Task;
        $task->content = $content;
        $task->list_id = $list_id;
        $task->is_done = $is_done;
        $task->save();
        return $task;
    }
}
