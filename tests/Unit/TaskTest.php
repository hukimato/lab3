<?php

use App\Domain\Task\Models\Task;
use App\Domain\MyList\Models\MyList;

uses(Tests\TestCase::class);

it('does not create Task without title field', function(){
    $response = $this->postJson('/api/v1/tasks', []);
    $response->assertStatus(422);
});

it('can create task', function(){
    $list = new MyList;
    $list->title = "testList";
    $list->save();
    $attributes = [
        'content' => 'UnitTestList',
        'list_id' => $list->id,
        'is_done' => false
    ];
    $response = $this->postJson('/api/v1/tasks', $attributes);

    $response->assertStatus(200);
    $this->assertDatabaseHas('tasks', $attributes);
});

it('cat get task', function(){
    $list = new MyList;
    $list->title = "testList";
    $list->save();

    $task = new Task;
    $task->content = 'test';
    $task->list_id = $list->id;
    $task->is_done = false;
    $task->save();

    $response = $this->getJson("/api/v1/tasks/{$task->id}");

    $data = [
        'data' => [
            'id' => $task->id,
            'content' => $task->content,
            'list_id' => $task->list_id,
            'is_done' => $task->is_done
        ],
        'errors' => [],
        'meta' => []
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('cat patch task', function(){
    $list = new MyList;
    $list->title = "testList";
    $list->save();

    $task = new Task;
    $task->content = 'test';
    $task->list_id = $list->id;
    $task->is_done = false;
    $task->save();

    $response = $this->patchJson("/api/v1/tasks/{$task->id}", ["content"=>"patch"]);

    $data = [
        'data' => [
            'id' => $task->id,
            'content' => 'patch',
            'list_id' => $task->list_id,
            'is_done' => $task->is_done
        ],
        'errors' => [],
        'meta' => []
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('cat put task', function(){
    $list = new MyList;
    $list->title = "testList";
    $list->save();

    $task = new Task;
    $task->content = 'test';
    $task->list_id = $list->id;
    $task->is_done = false;
    $task->save();

    $response = $this->patchJson("/api/v1/tasks/{$task->id}", ["content"=>"put"]);

    $data = [
        'data' => [
            'id' => $task->id,
            'content' => 'put',
            'list_id' => $task->list_id,
            'is_done' => $task->is_done
        ],
        'errors' => [],
        'meta' => []
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('can delete task', function(){
    $list = new MyList;
    $list->title = "testList";
    $list->save();

    $task = new Task;
    $task->content = 'test';
    $task->list_id = $list->id;
    $task->is_done = false;
    $task->save();

    $response = $this->deleteJson("/api/v1/tasks/{$task->id}");

    $data = [
        'data' => '',
                'errors' => '',
                'meta' => [
                    'success' => 'Deleted'
                ]
    ];

    $response->assertStatus(200)->assertJson($data);
});

