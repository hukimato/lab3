<?php

namespace App\Http\ApiV1\Modules\Tasks\Controllers;

use App\Domain\Task\Actions\ListTaskAction;
use App\Domain\Task\Actions\CreateTaskAction;
use App\Domain\Task\Actions\GetTaskAction;
use App\Domain\Task\Actions\PatchTaskAction;
use App\Domain\Task\Actions\PutTaskAction;
use App\Domain\Task\Actions\DeleteTaskAction;

use App\Domain\Task\Models\Task;
use App\Domain\MyList\Models\MyList;

use App\Http\ApiV1\Modules\Tasks\Requests\CreateTaskRequest;
use App\Http\ApiV1\Modules\Tasks\Requests\DeleteTaskRequest;
use App\Http\ApiV1\Modules\Tasks\Requests\GetTaskRequest;
use App\Http\ApiV1\Modules\Tasks\Requests\ListTaskRequest;
use App\Http\ApiV1\Modules\Tasks\Requests\PatchTaskRequest;
use App\Http\ApiV1\Modules\Tasks\Requests\PutTaskRequest;

use App\Http\ApiV1\Modules\Tasks\Resources\TaskResource;
use App\Http\ApiV1\Modules\Tasks\Resources\TaskCollection;
use App\Http\ApiV1\Task\Resources\TaskResource as ResourcesTaskResource;
use Illuminate\Http\Request;
use stdClass;
use App\Http\Resources\ErrorResource;

class TaskController
{
    public function list(ListTaskRequest $request,
    ListTaskAction $action
    )   {
        $skip = $request->input('skip');
        $take = $request->input('take');
        $list_id = $request->input('list_id');
        if($list_id === null)
        {
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'TooFewParam',
                    'message' => "list_id is required"
                ],
                'meta' => ''
            ], 400);
        }
        if($skip == null || $take == null){
            return new TaskCollection($action->execute(0, 0, $list_id));
        }
        return new TaskCollection($action->execute($skip, $take, $list_id));
    }
    
    public function create(CreateTaskRequest $request,
                           CreateTaskAction $action
    )   {
        $data = $request->validated();
        $content = $data['content'];
        $list_id = $data['list_id'];
        $is_done = $data['is_done'];
        return (new TaskResource($action->execute($content, $list_id, $is_done)))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);
    }

    public function get(int $id
    )   {
        $task = Task::find($id);
        if($task == null)
        {
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "Task with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        return (new TaskResource($task))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);;
    }

    public function put(int $id, 
                        PutTaskRequest $request,
                        PutTaskAction $action
    )   {
        if(Task::find($id)==null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "Task with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        $data = $request->validated();
        $content = (array_key_exists('content', $data) && empty($data['content'])? $data['content'] : null);
        $list_id = (array_key_exists('list_id', $data)? $data['list_id'] : null);
        $is_done = (array_key_exists('is_done', $data)? $data['is_done'] : null);
        if($list_id != null && MyList::find($list_id)==null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "MyList with id {$list_id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        return (new TaskResource($action->execute($id, $content, $list_id, $is_done)))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);
    }

    public function patch(  int $id, 
    PatchTaskRequest $request,
                            PatchTaskAction $action
    )   {
        if(Task::find($id)==null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "Task with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        $data = $request->validated();
        $content = (array_key_exists('content', $data)? $data['content'] : null);
        $list_id = (array_key_exists('list_id', $data)? $data['list_id'] : null);
        $is_done = (array_key_exists('is_done', $data)? $data['is_done'] : null);
        if($list_id != null && MyList::find($list_id)==null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "MyList with id {$list_id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        return (new TaskResource($action->execute($id, $content, $list_id, $is_done)))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);
    }

    public function delete(int $id, DeleteTaskAction $action
    )   {
        $seccess = $action->execute($id);
        if ($seccess)
        {
            return response()->json([
                'data' => '',
                'errors' => '',
                'meta' => [
                    'success' => 'Deleted'
                ]
            ], 200);
        }
        else 
        {
            if(Task::find($id)==null){
                return response()->json([
                    'data' => '',
                    'errors' => [
                        'code' => 'NotFoundResource',
                        'message' => "Task with id {$id} not found."
                    ],
                    'meta' => ''
                ], 400);
            }
        }
    }
}
