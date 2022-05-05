<?php

namespace App\Domain\Task\Actions;

use App\Domain\Task\Models\Task;

class GetTaskAction
{
    public function execute(int $taskId, array $fields): Task
    {
        $task = Task::findOrFail($taskId);
        return $task;   
    }
}
