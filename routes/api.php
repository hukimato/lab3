<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\ApiV1\MyLists\Controllers\MyListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('v1/my-lists', 'App\Http\ApiV1\Modules\MyLists\Controllers\MyListController@list');
Route::post('v1/my-lists', 'App\Http\ApiV1\Modules\MyLists\Controllers\MyListController@create');
Route::get('v1/my-lists/{id}', 'App\Http\ApiV1\Modules\MyLists\Controllers\MyListController@get');
Route::put('v1/my-lists/{id}', 'App\Http\ApiV1\Modules\MyLists\Controllers\MyListController@put');
Route::patch('v1/my-lists/{id}', 'App\Http\ApiV1\Modules\MyLists\Controllers\MyListController@patch');
Route::delete('v1/my-lists/{id}', 'App\Http\ApiV1\Modules\MyLists\Controllers\MyListController@delete');

Route::get('v1/tasks', 'App\Http\ApiV1\Modules\Tasks\Controllers\TaskController@list');
Route::post('v1/tasks', 'App\Http\ApiV1\Modules\Tasks\Controllers\TaskController@create');
Route::get('v1/tasks/{id}', 'App\Http\ApiV1\Modules\Tasks\Controllers\TaskController@get');
Route::put('v1/tasks/{id}', 'App\Http\ApiV1\Modules\Tasks\Controllers\TaskController@put');
Route::patch('v1/tasks/{id}', 'App\Http\ApiV1\Modules\Tasks\Controllers\TaskController@patch');
Route::delete('v1/tasks/{id}', 'App\Http\ApiV1\Modules\Tasks\Controllers\TaskController@delete');

