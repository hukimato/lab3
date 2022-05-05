<?php

use App\Domain\MyList\Models\MyList;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class);

it('does not create myList without title field', function(){
    $response = $this->postJson('/api/v1/my-lists', []);
    $response->assertStatus(400);
});

it('can create list', function(){
    $attributes = [
        'title' => 'UnitTestList',
    ];
    $response = $this->postJson('/api/v1/my-lists', $attributes);
    $response->assertStatus(200);
    $this->assertDatabaseHas('my_lists', $attributes);
});

it('cat get mylist', function(){
    $list = new MyList;
    $list->title = 'test';
    $list->save();

    $response = $this->getJson("/api/v1/my-lists/{$list->id}");

    $data = [
        'data' => [
            'id' => $list->id,
            'title' => $list->title,
        ],
        'errors' => [],
        'meta' => []
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('cat patch mylist', function(){
    $list = new MyList;
    $list->title = 'test';
    $list->save();

    $response = $this->patchJson("/api/v1/my-lists/{$list->id}", ['title'=>'patch']);

    $data = [
        'data' => [
            'id' => $list->id,
            'title' => 'patch',
        ],
        'errors' => [],
        'meta' => []
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('cat put mylist', function(){
    $list = new MyList;
    $list->title = 'test';
    $list->save();

    $response = $this->putJson("/api/v1/my-lists/{$list->id}", ['title'=>'put']);

    $data = [
        'data' => [
            'id' => $list->id,
            'title' => 'put',
        ],
        'errors' => [],
        'meta' => []
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('can delete', function(){
    $list = new MyList;
    $list->title = 'test';
    $list->save();

    $response = $this->deleteJson("/api/v1/my-lists/{$list->id}");

    $data = [
        'data' => '',
                'errors' => '',
                'meta' => [
                    'success' => 'Deleted'
                ]
    ];

    $response->assertStatus(200)->assertJson($data);
});

